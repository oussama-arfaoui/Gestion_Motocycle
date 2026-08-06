<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;

class InspectChassisOrdersExcel extends Command
{
    protected $signature = 'chassis-orders:inspect-excel {file} {--sheets=3}';
    protected $description = 'Dump raw cell values (A1:T35) for a few sheets to find the real invoice date location';

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

        $limit = (int)$this->option('sheets');
        $picked = array_slice($sheetNames, 0, $limit);
        // also grab one from the middle and one from the end
        if (count($sheetNames) > 10) {
            $picked[] = $sheetNames[intdiv(count($sheetNames), 2)];
            $picked[] = $sheetNames[count($sheetNames) - 1];
        }
        $picked = array_unique($picked);

        foreach ($picked as $sheetName) {
            $this->info("===== SHEET: $sheetName =====");
            $reader->setLoadSheetsOnly([$sheetName]);
            $spreadsheet = $reader->load($file);
            $ws = $spreadsheet->getActiveSheet();

            for ($row = 1; $row <= 20; $row++) {
                $rowVals = [];
                for ($col = 1; $col <= 15; $col++) {
                    $coord = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col) . $row;
                    $val = $ws->getCell($coord)->getValue();
                    if ($val !== null && trim((string)$val) !== '') {
                        $rowVals[] = $coord . '=' . trim((string)$val);
                    }
                }
                if (!empty($rowVals)) {
                    $this->line('Row ' . $row . ': ' . implode(' | ', $rowVals));
                }
            }

            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);
        }

        return 0;
    }
}
