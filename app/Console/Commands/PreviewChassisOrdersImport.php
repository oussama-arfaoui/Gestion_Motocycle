<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PreviewChassisOrdersImport extends Command
{
    protected $signature = 'chassis-orders:preview-import {file} {--output=storage/app/chassis_orders_preview.json}';
    protected $description = 'Preview import from invoice Excel: parse sheets and dump JSON';

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
        $this->info('Total sheets: ' . count($allSheetNames));

        // Only process 2026 invoices in the 1060-1541 range to match the requested 481 orders.
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
        $this->info('Filtered sheets: ' . count($sheetNames));

        $orders = [];
        $orderCounter = 1060;

        foreach ($sheetNames as $idx => $sheetName) {
            $invoiceNo = (int)explode(',', $sheetName)[0];
            if (($idx + 1) % 50 === 0) {
                $this->info('Processing sheet ' . ($idx + 1) . '/' . count($sheetNames) . " ($sheetName)");
            }

            $reader->setLoadSheetsOnly([$sheetName]);
            $spreadsheet = $reader->load($file);
            $ws = $spreadsheet->getActiveSheet();

            // Date
            $dateRaw = $this->getCell($ws, 'M8');
            $date = $this->parseDate($dateRaw);

            // Client info (usually R11 or R12, format: "NAME CIN")
            $clientRaw = $this->getCell($ws, 'A11') ?: $this->getCell($ws, 'A12') ?: $this->getCell($ws, 'G11') ?: $this->getCell($ws, 'I12') ?: '';
            $clientParts = $this->parseClient($clientRaw);

            // Invoice number from R19
            $invoiceText = $this->getCell($ws, 'B19');
            $invoiceYear = $this->parseInvoiceNumber($invoiceText);

            // Product line R30
            $productLine = $this->getCell($ws, 'A30');
            $productName = '';
            $chassisNumber = '';
            if ($productLine) {
                $productName = trim(preg_replace('/N°chassis:.*/i', '', $productLine));
                if (preg_match('/N°chassis:\s*([^\s]+)/i', $productLine, $cm)) {
                    $chassisNumber = trim($cm[1]);
                }
            }

            // Alternate prices in S30 / T30
            $mainPrice = $this->toFloat($this->getCell($ws, 'P30'));
            $altS = $this->toFloat($this->getCell($ws, 'S30'));
            $altT = $this->toFloat($this->getCell($ws, 'T30'));
            $altPrice = $altS ?: $altT;

            // Final selling price logic: if alt exists, is less than main, and is not HT (alt > main/1.2), use alt
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

            // Color
            $color = '';
            $colorLine = $this->getCell($ws, 'A31');
            if (preg_match('/Couleur\s*:\s*(.+)/i', $colorLine, $colm)) {
                $color = trim($colm[1]);
            }

            $orders[] = [
                'order_number' => 'N' . $orderCounter . '/26',
                'invoice_no'   => $invoiceYear ?: $invoiceNo . '/26',
                'date'         => $date,
                'customer_name' => $clientParts['name'],
                'doc_number'   => $clientParts['cin'],
                'product_name' => $productName,
                'chassis_number' => $chassisNumber,
                'color'        => $color,
                'main_ttc'     => number_format($mainPrice, 2, '.', ''),
                'alternate_price' => $altPrice > 0 ? number_format($altPrice, 2, '.', '') : 0,
                'selected_price_note' => $priceNote,
                'total_ht'     => number_format($totalHt, 2, '.', ''),
                'tva'          => number_format($tva, 2, '.', ''),
                'total_ttc'    => number_format($finalTtc, 2, '.', ''),
                'sheet'        => $sheetName,
            ];

            $orderCounter++;
            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);
        }

        $this->info('Parsed ' . count($orders) . ' orders.');

        $outputPath = $this->option('output');
        $fullPath = base_path($outputPath);
        file_put_contents($fullPath, json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $this->info('JSON written to: ' . $fullPath);

        // Show first/last samples
        $this->info("\n--- First 3 ---");
        foreach (array_slice($orders, 0, 3) as $o) {
            $this->line(json_encode($o, JSON_UNESCAPED_UNICODE));
        }
        $this->info("\n--- Last 3 ---");
        foreach (array_slice($orders, -3) as $o) {
            $this->line(json_encode($o, JSON_UNESCAPED_UNICODE));
        }

        return 0;
    }

    private function getCell($ws, $coord)
    {
        $val = $ws->getCell($coord)->getValue();
        return $val !== null ? trim((string)$val) : '';
    }

    private function toFloat($val)
    {
        if (empty($val)) return 0;
        $s = str_replace([' ', ','], ['', '.'], (string)$val);
        return is_numeric($s) ? (float)$s : 0;
    }

    private function parseClient($raw)
    {
        $raw = trim($raw);
        if (empty($raw)) return ['name' => '', 'cin' => ''];
        // Common patterns: "FARID AIT BOUSSALHAM EA90306" or "HASSANE AZHARI BH300567"
        // Last "word" is usually CIN
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
