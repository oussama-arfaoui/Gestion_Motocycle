<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\IOFactory;

class InspectExcel extends Command
{
    protected $signature = 'excel:inspect {file}';
    protected $description = 'Inspect Excel file structure';

    public function handle()
    {
        $file = $this->argument('file');
        if (!file_exists($file)) {
            $this->error("File not found: $file");
            return 1;
        }

        // Use PhpSpreadsheet directly for sheet names (fast)
        $reader = IOFactory::createReaderForFile($file);
        $reader->setReadDataOnly(true);
        $sheets = $reader->listWorksheetNames($file);
        $this->info('SHEETS: ' . implode(', ', $sheets));

        $this->info('TOTAL SHEETS: ' . count($sheets));

        // Find sheets containing 1060 to 1541
        $targetSheets = [];
        foreach ($sheets as $idx => $name) {
            if (preg_match('/\b(10[6-9][0-9]|1[0-5][0-9][0-9])\b/', $name, $m)) {
                $targetSheets[] = $name;
            }
            if (count($targetSheets) > 15) break;
        }
        $this->info('Sample matching sheets: ' . implode(', ', array_slice($targetSheets, 0, 10)));

        foreach ($sheets as $index => $sheetName) {
            if (!preg_match('/\b(1060|1076|1100|1200|1300|1400|1500|1541)\b/', $sheetName)) {
                continue;
            }

            $this->info("\n=== SHEET #$index: $sheetName ===");

            $reader->setLoadSheetsOnly([$sheetName]);
            $spreadsheet = $reader->load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            $maxRow = min($worksheet->getHighestRow(), 50);
            $maxCol = $worksheet->getHighestColumn();
            $this->info("Dimensions: $maxRow rows x $maxCol columns");

            for ($row = 1; $row <= $maxRow; $row++) {
                $line = "R$row: ";
                for ($col = 'A'; $col <= $maxCol; $col++) {
                    $value = $worksheet->getCell($col . $row)->getValue();
                    if ($value !== null && $value !== '') {
                        $line .= "[$col] " . json_encode((string)$value) . " ";
                    }
                }
                $this->line($line);
            }

            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);
        }

        return 0;
    }
}
