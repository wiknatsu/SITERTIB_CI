<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\Files\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

trait ExcelImportTrait
{
    protected function loadSpreadsheetFromFile(UploadedFile $file): Spreadsheet
    {
        if (!$file->isValid()) {
            throw new \RuntimeException('Unggah file tidak valid.');
        }

        $extension = strtolower($file->getClientExtension() ?: $file->getExtension());
        if (!in_array($extension, ['xls', 'xlsx', 'csv'])) {
            throw new \RuntimeException('Format file tidak didukung. Gunakan .xls, .xlsx, atau .csv.');
        }

        if ($extension === 'csv') {
            $reader = IOFactory::createReader('Csv');
            $reader->setDelimiter(',');
            $reader->setEnclosure('"');
            $reader->setSheetIndex(0);
        } else {
            $reader = IOFactory::createReaderForFile($file->getTempName());
        }
        $reader->setReadDataOnly(true);

        return $reader->load($file->getTempName());
    }

    protected function sendSpreadsheetResponse(Spreadsheet $spreadsheet, string $filename)
    {
        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $content = ob_get_clean();

        return $this->response
            ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($content);
    }
}
