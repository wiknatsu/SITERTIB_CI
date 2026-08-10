<?php

namespace App\Controllers;

use App\Models\TahunAjaranModel;

class Pages extends BaseController
{
    private function getActiveTahunAjaran(): ?object
    {
        $activeYear = model(TahunAjaranModel::class)->getActive();
        return $activeYear !== null ? (object) $activeYear : null;
    }

    public function landing(): string
    {
        return view('pages/landing', [
            'tahunAjaranAktif' => $this->getActiveTahunAjaran(),
        ]);
    }

    public function login(): string
    {
        return view('pages/login', [
            'tahunAjaranAktif' => $this->getActiveTahunAjaran(),
        ]);
    }

    public function dashboard(): string
    {
        return view('pages/dashboard');
    }

    public function catatPelanggaran(): string
    {
        return view('pages/catat-pelanggaran');
    }

    public function riwayatPelanggaran(): string
    {
        return view('pages/riwayat-pelanggaran');
    }

    public function murid(): string
    {
        return view('pages/murid');
    }

    public function guru(): string
    {
        return view('pages/guru');
    }

    public function jenisPelanggaran(): string
    {
        return view('pages/jenis-pelanggaran');
    }

    public function tahunAjaran(): string
    {
        return view('pages/tahun-ajaran');
    }

    public function users(): string
    {
        return view('pages/users');
    }

    public function sistemBackup(): string
    {
        return view('pages/sistem-backup');
    }

    public function muridListPelanggaran(): string
    {
        return view('pages/murid_list-pelanggaran');
    }
}
