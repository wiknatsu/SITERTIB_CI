<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use CodeIgniter\API\ResponseTrait;

class GuruController extends BaseController
{
    use ResponseTrait;
    use ExcelImportTrait;

    public function index()
    {
        $model = model(GuruModel::class);
        $nama = $this->request->getGet('nama');
        $nip = $this->request->getGet('nip');
        $search = $this->request->getGet('search');

        return $this->respond($model->getByFilters($nama, $nip, $search));
    }

    public function show($id = null)
    {
        $model = model(GuruModel::class);
        $guru = $model->find($id);

        if ($guru === null) {
            return $this->failNotFound('Guru not found');
        }

        return $this->respond($guru);
    }

    public function create()
    {
        $rules = [
            'nip' => 'required|string|is_unique[guru.nip]',
            'nama' => 'required|string|max_length[255]',
            'gender' => 'required|in_list[L,P]',
            'jabatan' => 'required|string|max_length[255]',
            'no_telp' => 'permit_empty|string|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $model = model(GuruModel::class);
        $data = [
            'nip' => $this->request->getVar('nip'),
            'nama' => $this->request->getVar('nama'),
            'gender' => $this->request->getVar('gender'),
            'jabatan' => $this->request->getVar('jabatan'),
            'no_telp' => $this->request->getVar('no_telp'),
        ];

        $id = $model->insert($data);

        return $this->respondCreated($model->find($id));
    }

    public function update($id = null)
    {
        $model = model(GuruModel::class);
        $guru = $model->find($id);

        if ($guru === null) {
            return $this->failNotFound('Guru not found');
        }

        $rules = [
            'nip' => 'permit_empty|string|is_unique[guru.nip,id,' . $id . ']',
            'nama' => 'permit_empty|string|max_length[255]',
            'gender' => 'permit_empty|in_list[L,P]',
            'jabatan' => 'permit_empty|string|max_length[255]',
            'no_telp' => 'permit_empty|string|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [];
        foreach (['nip', 'nama', 'gender', 'jabatan', 'no_telp'] as $field) {
            $value = $this->request->getVar($field);
            if ($value !== null && $value !== '') {
                $data[$field] = $value;
            }
        }

        if (empty($data)) {
            return $this->respond($guru);
        }

        $model->update($id, $data);

        return $this->respond($model->find($id));
    }

    public function delete($id = null)
    {
        $model = model(GuruModel::class);
        $guru = $model->find($id);

        if ($guru === null) {
            return $this->failNotFound('Guru not found');
        }

        $model->delete($id);

        return $this->respond([
            'message' => 'Guru deleted successfully',
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

            $model = model(GuruModel::class);
            $inserted = 0;
            $skipped = 0;
            $warnings = [];

            foreach ($rows as $index => $row) {
                if ($index === 1) {
                    continue;
                }

                $nip = trim($row['A'] ?? '');
                $nama = trim($row['B'] ?? '');
                $gender = strtoupper(trim($row['C'] ?? ''));
                $jabatan = trim($row['D'] ?? '');
                $noTelp = trim($row['E'] ?? '');

                if ($nip === '' && $nama === '' && $gender === '' && $jabatan === '' && $noTelp === '') {
                    continue;
                }

                if ($nip === '' || $nama === '' || !in_array($gender, ['L', 'P'], true)) {
                    $warnings[] = "Baris {$index} diabaikan: NIP, Nama, dan Gender (L/P) wajib diisi.";
                    $skipped++;
                    continue;
                }

                if ($model->where('nip', $nip)->first() !== null) {
                    $warnings[] = "Baris {$index} diabaikan: NIP {$nip} sudah ada.";
                    $skipped++;
                    continue;
                }

                $model->insert([
                    'nip' => $nip,
                    'nama' => $nama,
                    'gender' => $gender,
                    'jabatan' => $jabatan,
                    'no_telp' => $noTelp,
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
        $model = model(GuruModel::class);
        $data = $model->findAll();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray([['NIP', 'Nama', 'Gender', 'Jabatan', 'No Telp']], null, 'A1');

        $rowIndex = 2;
        foreach ($data as $row) {
            $sheet->fromArray([[
                $row['nip'],
                $row['nama'],
                $row['gender'],
                $row['jabatan'],
                $row['no_telp'],
            ]], null, 'A' . $rowIndex);
            $rowIndex++;
        }

        return $this->sendSpreadsheetResponse($spreadsheet, 'Data_Guru_' . date('Ymd_His') . '.xlsx');
    }
}
