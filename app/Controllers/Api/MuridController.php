<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\MuridModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class MuridController extends BaseController
{
    use ResponseTrait;
    use ExcelImportTrait;

    public function index()
    {
        $model = model(MuridModel::class);
        $nama = $this->request->getGet('nama');
        $nis = $this->request->getGet('nis');
        $kelas = $this->request->getGet('kelas');

        return $this->respond($model->getByFilters($nama, $nis, $kelas));
    }

    public function show($id = null)
    {
        $model = model(MuridModel::class);
        $murid = $model->find($id);

        if ($murid === null) {
            return $this->failNotFound('Murid not found');
        }

        return $this->respond($murid);
    }

    public function create()
    {
        $rules = [
            'nis' => 'required|string|is_unique[murid.nis]',
            'nisn' => 'required|string|is_unique[murid.nisn]',
            'nama' => 'required|string|max_length[255]',
            'gender' => 'required|in_list[L,P]',
            'kelas' => 'required|string|max_length[50]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $model = model(MuridModel::class);
        $data = [
            'nis' => $this->request->getVar('nis'),
            'nisn' => $this->request->getVar('nisn'),
            'nama' => $this->request->getVar('nama'),
            'gender' => $this->request->getVar('gender'),
            'kelas' => $this->request->getVar('kelas'),
        ];

        $id = $model->insert($data);

        return $this->respondCreated($model->find($id));
    }

    public function update($id = null)
    {
        $model = model(MuridModel::class);
        $murid = $model->find($id);

        if ($murid === null) {
            return $this->failNotFound('Murid not found');
        }

        $rules = [
            'nis' => 'permit_empty|string|is_unique[murid.nis,id,' . $id . ']',
            'nisn' => 'permit_empty|string|is_unique[murid.nisn,id,' . $id . ']',
            'nama' => 'permit_empty|string|max_length[255]',
            'gender' => 'permit_empty|in_list[L,P]',
            'kelas' => 'permit_empty|string|max_length[50]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [];
        foreach (['nis', 'nisn', 'nama', 'gender', 'kelas'] as $field) {
            $value = $this->request->getVar($field);
            if ($value !== null && $value !== '') {
                $data[$field] = $value;
            }
        }

        if (empty($data)) {
            return $this->respond($murid);
        }

        $model->update($id, $data);

        return $this->respond($model->find($id));
    }

    public function delete($id = null)
    {
        $model = model(MuridModel::class);
        $murid = $model->find($id);

        if ($murid === null) {
            return $this->failNotFound('Murid not found');
        }

        $model->delete($id);

        return $this->respond([
            'message' => 'Murid deleted successfully',
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

            $model = model(MuridModel::class);
            $inserted = 0;
            $skipped = 0;
            $warnings = [];

            foreach ($rows as $index => $row) {
                if ($index === 1) {
                    continue;
                }

                $nis = trim($row['A'] ?? '');
                $nisn = trim($row['B'] ?? '');
                $nama = trim($row['C'] ?? '');
                $gender = strtoupper(trim($row['D'] ?? ''));
                $kelas = trim($row['E'] ?? '');

                if ($nis === '' && $nisn === '' && $nama === '' && $gender === '' && $kelas === '') {
                    continue;
                }

                if ($nis === '' || $nisn === '' || $nama === '' || !in_array($gender, ['L', 'P'], true) || $kelas === '') {
                    $warnings[] = "Baris {$index} diabaikan: NIS, NISN, Nama, Gender (L/P), dan Kelas wajib diisi.";
                    $skipped++;
                    continue;
                }

                if ($model->where('nis', $nis)->orWhere('nisn', $nisn)->first() !== null) {
                    $warnings[] = "Baris {$index} diabaikan: NIS atau NISN sudah ada.";
                    $skipped++;
                    continue;
                }

                $model->insert([
                    'nis' => $nis,
                    'nisn' => $nisn,
                    'nama' => $nama,
                    'gender' => $gender,
                    'kelas' => $kelas,
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
        $model = model(MuridModel::class);
        $data = $model->findAll();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray([['NIS', 'NISN', 'Nama', 'Gender', 'Kelas']], null, 'A1');

        $rowIndex = 2;
        foreach ($data as $row) {
            $sheet->fromArray([[
                $row['nis'],
                $row['nisn'],
                $row['nama'],
                $row['gender'],
                $row['kelas'],
            ]], null, 'A' . $rowIndex);
            $rowIndex++;
        }

        return $this->sendSpreadsheetResponse($spreadsheet, 'Data_Murid_' . date('Ymd_His') . '.xlsx');
    }
}
