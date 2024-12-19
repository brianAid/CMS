<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    public function __construct()
    {
        helper(['url']);
    }
    public function index()
    {
        helper('form');
        $KategoriModel = new KategoriModel();
        $kategori = $KategoriModel->findAll();

        return view('admin/kategori_index', ['kategori' => $kategori]);
    }
    public function saveKategori()
    {
        $post = [
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ];
        $KategoriModel = new KategoriModel();
        if ($KategoriModel->save($post) === false) {
            return redirect()->back()->with('errors', $KategoriModel->errors());
        }
        session()->setFlashdata('alert', '
                    <div class="alert alert-success alert-dismissible" role="alert">
                    berhasil menambahkan kategori
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        ');
        return redirect()->back();
    }
    public function deleteKategori($id)
    {
        $id = intval($id);
        $KategoriModel = new KategoriModel();
        if ($KategoriModel->find($id)) {
            $KategoriModel->delete($id);
            return redirect()->back()->with('success', 'berhasil menghapus data');
        } else {
            return redirect()->back()->with('error', 'kategori tidak ditemukan');
        }
    }
    public function editKategori($id)
    {
        $id = intval($id);

        $post = [
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ];
        $KategoriModel = new KategoriModel();
        $KategoriModel->update($id, $post);
        if ($KategoriModel) {
            return redirect()->back()->with('success', 'Berhasil update kategori');
        } else {
            return redirect()->back()->with('error', 'kategori tidak ditemukan');
        }
    }
}
