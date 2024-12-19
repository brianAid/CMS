<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KonfigurasiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Konfigurasi extends BaseController
{
    public function index()
    {
        helper('form');
        $KonfigurasiModel = new KonfigurasiModel();
        $konfigurasi = $KonfigurasiModel->first();

        return view('admin/konfigurasi_index', ['konfigurasi' => $konfigurasi]);
    }
    public function editKonfigurasi($id)
    {
        $post = [
            'judul_website' => $this->request->getVar('judul_website'),
            'profil_website' => $this->request->getVar('profil_website'),
            'instagram' => $this->request->getVar('instagram'),
            'facebook' => $this->request->getVar('facebook'),
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'no_wa' => $this->request->getVar('no_wa'),
        ];

        $KonfigurasiModel = new KonfigurasiModel();
        $KonfigurasiModel->update($id, $post);
        if ($KonfigurasiModel) {
            return redirect()->back()->with('success', 'Berhasil update konfigurasi');
        } else {
            return redirect()->back()->with('error', 'konfigurasi tidak ditemukan');
        }
    }
}
