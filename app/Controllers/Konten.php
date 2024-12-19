<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\KontenModel;
use CodeIgniter\Files\File;
helper('filesystem');
class Konten extends BaseController
{
    protected $imgPath = ROOTPATH . 'assets/upload/konten/';
    public function index()
    {
        $KategoriModel = new KategoriModel();
        $kategori = $KategoriModel->findAll();
        helper('form');
        $KontenModel = new KontenModel();
        $konten = $KontenModel
            ->join('kategori', 'konten.id_kategori = kategori.id_kategori')
            ->orderBy('tanggal', 'DESC')->findAll();
        return view('admin/konten_index', ['konten' => $konten, 'kategori' => $kategori]);
    }
    public function saveKonten()
    {
        $validationRule = [
            'foto' => [
                'label' => 'Foto',
                'rules' => [
                    'uploaded[foto]',
                    'is_image[foto]',
                    'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                ],
            ],
        ];
        $validated = $this->validate($validationRule);
        if (!$validated) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $img = $this->request->getFile('foto');
        if (!$img->hasMoved()) {
            $DateTime = date('Y-m-d');
            $newName = date('Y-m-d-H-i-s') . $img->getClientName();
            $img->move($this->imgPath, $newName);

        } else {
            return redirect()->back()->with('errors', 'The file has already been moved.');
        }
        $data = [
            'judul' => $this->request->getVar("judul"),
            'keterangan' => $this->request->getVar("keterangan"),
            'id_kategori' => $this->request->getVar("id_kategori"),
            'foto' => $newName,
            'slug' => str_replace(' ', '-', $this->request->getVar('judul')),
            'tanggal' => $DateTime,
            'username' => session()->get('username')
        ];
        $KontenModel = new KontenModel();
        $KontenModel->save($data);
        return redirect()->back()->with('success', 'berhasil menambah konten');
    }
    public function deleteKonten($id)
    {
        $id = intval($id);
        $KontenModel = new KontenModel();
        $konten = $KontenModel->find($id);
        if ($konten) {
            if (file_exists($this->imgPath . $konten['foto'])) {
                unlink($this->imgPath . $konten['foto']);
            }
            $KontenModel->delete($id);
            return redirect()->back()->with('success', 'berhasil menghapus data');
        } else {
            return redirect()->back()->with('error', 'konten tidak ditemukan');
        }
    }
    public function editKonten($id)
    {
        $id = intval($id);
        $KontenModel = new KontenModel();
        $oldData = $KontenModel->find($id);
        $img = $this->request->getFile('foto');
        $validationRule = [];
        if ($img && $img->isValid()) {
            $validationRule = [
                'foto' => [
                    'label' => 'Foto',
                    'rules' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                ],
            ];

            if (!$this->validate($validationRule)) {
                return redirect()->back()->with('errors', $this->validator->getErrors());
            }
        }

        $DateTime = date('Y-m-d');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            if (file_exists($this->imgPath . $oldData['foto'])) {
                unlink($this->imgPath . $oldData['foto']);
            }
            $newName = date('Y-m-d-H-i-s') . $img->getClientName();
            $img->move($this->imgPath, $newName);
            $data = [
                'judul' => $this->request->getVar("judul"),
                'keterangan' => $this->request->getVar("keterangan"),
                'id_kategori' => $this->request->getVar("id_kategori"),
                'foto' => $newName,
                'slug' => str_replace(' ', '-', $this->request->getVar('judul')),
                'tanggal' => $DateTime,
                'username' => session()->get('username')
            ];
        } else if ($img->isValid()) {
            return redirect()->back()->with('errors', 'The file has already been moved.');
        } else {
            $data = [
                'judul' => $this->request->getVar("judul"),
                'keterangan' => $this->request->getVar("keterangan"),
                'id_kategori' => $this->request->getVar("id_kategori"),
                'slug' => str_replace(' ', '-', $this->request->getVar('judul')),
                'tanggal' => $DateTime,
                'username' => session()->get('username')
            ];
        }
        $KontenModel = new KontenModel();
        $KontenModel->update($id, $data);
        return redirect()->back()->with('success', 'berhasil mengedit konten');
    }
}
