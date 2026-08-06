<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ChassisOrder;
use App\Models\ChassisOrderItem;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportChassisOrdersExcel extends Command
{
    protected $signature = 'chassis-orders:import-excel
                            {file : Path to facture visite.xlsx}
                            {--start=1060 : First order number}
                            {--json=storage/app/chassis_orders_imported.json : Output JSON path}
                            {--skip-delete : Do not delete existing orders}
                            {--fill-missing : Create placeholder rows for missing invoice numbers in the 1060-1541 range}';

    protected $description = 'Import chassis orders from invoice Excel workbook';

    public function handle()
    {
        $file = $this->argument('file');
        if (!file_exists($file)) {
            $this->error("File not found: $file");
            return 1;
        }

        $reader = IOFactory::createReaderForFile($file);
        $reader->setReadDataOnly(true);
        $allSheetNames = $reader->listWorksheetNames($file);

        $sheetNames = [];
        foreach ($allSheetNames as $name) {
            if (preg_match('/^(\d+),26\b/', $name, $m)) {
                $inv = (int)$m[1];
                if ($inv >= 1060 && $inv <= 1541) {
                    $sheetNames[] = $name;
                }
            }
        }
        sort($sheetNames);
        $this->info('Total sheets: ' . count($allSheetNames));
        $this->info('Sheets to import: ' . count($sheetNames));

        $orders = [];
        $importedNumbers = [];

        $defaultUserId = User::orderBy('id')->value('id') ?? 1;
        $defaultStoreId = Store::orderBy('id')->value('id') ?? 1;

        DB::beginTransaction();
        try {
            if (!$this->option('skip-delete')) {
                $this->warn('Deleting existing chassis orders and items...');
                DB::table('chassis_order_items')->delete();
                DB::table('chassis_orders')->delete();
                $this->info('Existing data removed.');
            }

            foreach ($sheetNames as $idx => $sheetName) {
                $invoiceNo = (int)explode(',', $sheetName)[0];
                if (in_array($invoiceNo, $importedNumbers, true)) {
                    $this->warn("Skipping duplicate sheet for invoice $invoiceNo: $sheetName");
                    continue;
                }
                $importedNumbers[] = $invoiceNo;
                if (($idx + 1) % 50 === 0) {
                    $this->info('Importing ' . ($idx + 1) . '/' . count($sheetNames) . " ($sheetName)");
                }

                $reader->setLoadSheetsOnly([$sheetName]);
                $spreadsheet = $reader->load($file);
                $ws = $spreadsheet->getActiveSheet();

                // Order number uses the actual invoice number from the sheet, not a counter.
                $orderNumber = 'N' . $invoiceNo . '/26';

                $dateRaw = $this->getCell($ws, 'M8');
                $date = $this->parseDate($dateRaw);

                $clientRaw = $this->getCell($ws, 'A11') ?: $this->getCell($ws, 'A12') ?: $this->getCell($ws, 'G11') ?: $this->getCell($ws, 'I12') ?: '';
                $clientParts = $this->parseClient($clientRaw);

                $invoiceText = $this->getCell($ws, 'B19');
                $invoiceYear = $this->parseInvoiceNumber($invoiceText) ?: $invoiceNo . '/26';

                $productLine = $this->getCell($ws, 'A30');
                $productName = '';
                $chassisNumber = '';
                if ($productLine) {
                    $productName = trim(preg_replace('/N°chassis:.*/i', '', $productLine));
                    if (preg_match('/N°chassis:\s*([^\s]+)/i', $productLine, $cm)) {
                        $chassisNumber = trim($cm[1]);
                    }
                }

                $mainPrice = $this->toFloat($this->getCell($ws, 'P30'));
                $altS = $this->toFloat($this->getCell($ws, 'S30'));
                $altT = $this->toFloat($this->getCell($ws, 'T30'));
                $altPrice = $altS ?: $altT;

                $finalTtc = $mainPrice;
                $priceNote = 'main';
                if ($altPrice > 0 && $altPrice < $mainPrice && $altPrice > ($mainPrice / 1.2)) {
                    $finalTtc = $altPrice;
                    $priceNote = 'alt';
                }

                $finalTtc = round($finalTtc, 2);
                $mainPrice = round($mainPrice, 2);
                $altPrice = round($altPrice, 2);
                $totalHt = round($finalTtc / 1.2, 2);
                $tva = round($finalTtc - $totalHt, 2);

                $color = '';
                $colorLine = $this->getCell($ws, 'A31');
                if (preg_match('/Couleur\s*:\s*(.+)/i', $colorLine, $colm)) {
                    $color = trim($colm[1]);
                }

                $order = ChassisOrder::create([
                    'order_number'   => $orderNumber,
                    'customer_name'  => $clientParts['name'],
                    'customer_phone' => '',
                    'doc_type'       => 'CIN',
                    'doc_number'     => $clientParts['cin'],
                    'total_price'    => $finalTtc,
                    'discount'       => 0,
                    'tva'            => 20,
                    'status'         => 'validated',
                    'user_id'        => $defaultUserId,
                    'store_id'       => $defaultStoreId,
                    'notes'          => "Invoice: $invoiceYear\nColor: $color\nSheet: $sheetName",
                    'comment'        => '',
                ]);

                // Preserve the original invoice date instead of using the current timestamp.
                if ($date) {
                    $order->timestamps = false;
                    $order->created_at = $date;
                    $order->updated_at = $date;
                    $order->save();
                    $order->timestamps = true;
                }

                $item = ChassisOrderItem::create([
                    'chassis_order_id'  => $order->id,
                    'chassis_number_id' => null,
                    'variant_id'        => null,
                    'chassis_number'    => $chassisNumber,
                    'model_name'        => $productName,
                    'family_name'       => $color,
                    'brand_name'        => '',
                    'price'             => $totalHt,
                    'location'          => '',
                ]);

                if ($date) {
                    $item->timestamps = false;
                    $item->created_at = $date;
                    $item->updated_at = $date;
                    $item->save();
                    $item->timestamps = true;
                }

                $orders[] = [
                    'order_number'        => $orderNumber,
                    'invoice_no'          => $invoiceYear,
                    'date'                => $date,
                    'customer_name'       => $clientParts['name'],
                    'doc_number'          => $clientParts['cin'],
                    'product_name'        => $productName,
                    'chassis_number'      => $chassisNumber,
                    'color'               => $color,
                    'main_ttc'            => number_format($mainPrice, 2, '.', ''),
                    'alternate_price'     => $altPrice > 0 ? number_format($altPrice, 2, '.', '') : 0,
                    'selected_price_note' => $priceNote,
                    'total_ht'            => number_format($totalHt, 2, '.', ''),
                    'tva'                 => number_format($tva, 2, '.', ''),
                    'total_ttc'           => number_format($finalTtc, 2, '.', ''),
                    'sheet'               => $sheetName,
                ];

                $spreadsheet->disconnectWorksheets();
                unset($spreadsheet);
            }

            // Detect missing invoice numbers in the 1060-1541 range.
            $allInvoiceNumbers = range(1060, 1541);
            $missing = array_values(array_diff($allInvoiceNumbers, $importedNumbers));

            if ($this->option('fill-missing')) {
                $this->info('Filling ' . count($missing) . ' missing placeholder orders...');
                foreach ($missing as $missingInv) {
                    $orderNumber = 'N' . $missingInv . '/26';
                    $placeholder = ChassisOrder::create([
                        'order_number'   => $orderNumber,
                        'customer_name'  => '',
                        'customer_phone' => '',
                        'doc_type'       => 'CIN',
                        'doc_number'     => '',
                        'total_price'    => 0,
                        'discount'       => 0,
                        'tva'            => 20,
                        'status'         => 'pending',
                        'user_id'        => $defaultUserId,
                        'store_id'       => $defaultStoreId,
                        'notes'          => 'Commande manquante - à compléter',
                        'comment'        => '',
                    ]);
                    $orders[] = [
                        'order_number'        => $orderNumber,
                        'invoice_no'          => $orderNumber,
                        'date'                => null,
                        'customer_name'       => '',
                        'doc_number'          => '',
                        'product_name'        => '',
                        'chassis_number'      => '',
                        'color'               => '',
                        'main_ttc'            => '0.00',
                        'alternate_price'     => 0,
                        'selected_price_note' => 'main',
                        'total_ht'            => '0.00',
                        'tva'                 => '0.00',
                        'total_ttc'           => '0.00',
                        'sheet'               => '',
                    ];
                }
            }

            $jsonPath = base_path($this->option('json'));
            file_put_contents($jsonPath, json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $this->info('JSON written to: ' . $jsonPath);

            DB::commit();

            $this->info('Imported ' . count($orders) . ' orders.');
            $this->info('First order: ' . ($orders[0]['order_number'] ?? 'none'));
            $this->info('Last order: ' . (count($orders) ? $orders[count($orders) - 1]['order_number'] : 'none'));
            if (!empty($missing)) {
                $this->warn('Missing invoices: ' . count($missing));
                if (!$this->option('fill-missing')) {
                    $this->warn('Run with --fill-missing to create placeholder rows for: ' . implode(', ', $missing));
                }
            }

            return 0;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Import failed: ' . $e->getMessage());
            $this->error($e->getTraceAsString());
            return 1;
        }
    }

    private function getCell($ws, $coord)
    {
        $val = $ws->getCell($coord)->getValue();
        return $val !== null ? trim((string)$val) : '';
    }

    private function toFloat($val)
    {
        if (empty($val)) return 0;
        $s = str_replace([' ', ',', ' '], ['', '.', '.'], (string)$val);
        return is_numeric($s) ? (float)$s : 0;
    }

    private function parseClient($raw)
    {
        $raw = trim($raw);
        if (empty($raw)) return ['name' => '', 'cin' => ''];
        $parts = preg_split('/\s+/', $raw);
        $cin = array_pop($parts);
        $name = implode(' ', $parts);
        return ['name' => trim($name), 'cin' => trim($cin)];
    }

    private function parseInvoiceNumber($text)
    {
        if (preg_match('/N°\s*(\d+)\s*\/\s*(\d+)/i', $text, $m)) {
            return $m[1] . '/' . $m[2];
        }
        return '';
    }

    private function parseDate($raw)
    {
        if (preg_match('/(\d{2})\/(\d{2})\/(\d{4})/', $raw, $m)) {
            return "$m[3]-$m[2]-$m[1]";
        }
        return null;
    }
}
