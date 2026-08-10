<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PelanggaranModel;
use CodeIgniter\API\ResponseTrait;

class PelanggaranController extends BaseController
{
    use ResponseTrait;
    use ExcelImportTrait;

    public function index()
    {
        $model = model(PelanggaranModel::class);
        $nama = $this->request->getGet('nama_pelanggaran');
        $kategori = $this->request->getGet('kategori_pelanggaran');

        return $this->respond($model->getByFilters($nama, $kategori));
    }

    public function show($id = null)
    {
        $model = model(PelanggaranModel::class);
        $data = $model->find($id);

        if ($data === null) {
            return $this->failNotFound('Pelanggaran not found');
        }

        return $this->respond($data);
    }

    public function create()
    {
        $rules = [
            'kode_pelanggaran' => 'required|string|is_unique[pelanggaran.kode_pelanggaran]',
            'nama_pelanggaran' => 'required|string|max_length[255]',
            'kategori_pelanggaran' => 'required|string|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $model = model(PelanggaranModel::class);
        $data = [
            'kode_pelanggaran' => $this->request->getVar('kode_pelanggaran'),
            'nama_pelanggaran' => $this->request->getVar('nama_pelanggaran'),
            'kategori_pelanggaran' => $this->request->getVar('kategori_pelanggaran'),
        ];

        $id = $model->insert($data);

        return $this->respondCreated($model->find($id));
    }

    public function update($id = null)
    {
        $model = model(PelanggaranModel::class);
        $dataExist = $model->find($id);

        if ($dataExist === null) {
            return $this->failNotFound('Pelanggaran not found');
        }

        $rules = [
            'kode_pelanggaran' => 'permit_empty|string|is_unique[pelanggaran.kode_pelanggaran,id,' . $id . ']',
            'nama_pelanggaran' => 'permit_empty|string|max_length[255]',
            'kategori_pelanggaran' => 'permit_empty|string|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [];
        foreach (['kode_pelanggaran', 'nama_pelanggaran', 'kategori_pelanggaran'] as $field) {
            $value = $this->request->getVar($field);
            if ($value !== null && $value !== '') {
                $data[$field] = $value;
            }
        }

        if (empty($data)) {
            return $this->respond($dataExist);
        }

        $model->update($id, $data);

        return $this->respond($model->find($id));
    }

    public function delete($id = null)
    {
        $model = model(PelanggaranModel::class);
        $data = $model->find($id);

        if ($data === null) {
            return $this->failNotFound('Pelanggaran not found');
        }

        $model->delete($id);

        return $this->respond([
            'message' => 'Pelanggaran deleted successfully',
        ]);
    }

    public function import()
    {
        try {
            $file = $this->request->getFile('file');
            if ($file === null) {
                return $this->fail('File tidak ditemukan.', 400);
            }

            $spreadsheet = $this->loadSpreadsheetFromFile($file);
            $rows = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            $model = model(PelanggaranModel::class);
            $inserted = 0;
            $skipped = 0;
            $warnings = [];

            foreach ($rows as $index => $row) {
                if ($index === 1) {
                    continue;
                }

                $kode = trim($row['A'] ?? '');
                $nama = trim($row['B'] ?? '');
                $kategori = trim($row['C'] ?? '');

                if ($kode === '' && $nama === '' && $kategori === '') {
                    continue;
                }

                if ($kode === '' || $nama === '' || $kategori === '') {
                    $warnings[] = "Baris {$index} diabaikan: Kode Pelanggaran, Nama Pelanggaran, dan Kategori wajib diisi.";
                    $skipped++;
                    continue;
                }

                if ($model->where('kode_pelanggaran', $kode)->first() !== null) {
                    $warnings[] = "Baris {$index} diabaikan: Kode Pelanggaran {$kode} sudah ada.";
                    $skipped++;
                    continue;
                }

                $model->insert([
                    'kode_pelanggaran' => $kode,
                    'nama_pelanggaran' => $nama,
                    'kategori_pelanggaran' => $kategori,
                ]);
                $inserted++;
            }

            return $this->respond([
                'message' => "Import selesai. {$inserted} baris dimasukkan, {$skipped} baris diabaikan.",
                'warnings' => $warnings,
            ]);
        } catch (\RuntimeException $e) {
            return $this->fail($e->getMessage(), 400);
        } catch (\Exception $e) {
            return $this->failServerError('Gagal memproses file import. ' . $e->getMessage());
        }
    }

    public function export()
    {
        $model = model(PelanggaranModel::class);
        $data = $model->findAll();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray([['Kode Pelanggaran', 'Nama Pelanggaran', 'Kategori Pelanggaran']], null, 'A1');

        $rowIndex = 2;
        foreach ($data as $row) {
            $sheet->fromArray([[
                $row['kode_pelanggaran'],
                $row['nama_pelanggaran'],
                $row['kategori_pelanggaran'],
            ]], null, 'A' . $rowIndex);
            $rowIndex++;
        }

        return $this->sendSpreadsheetResponse($spreadsheet, 'Data_Pelanggaran_' . date('Ymd_His') . '.xlsx');
    }
}
