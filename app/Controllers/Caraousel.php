<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CaraouselModel;
use CodeIgniter\HTTP\ResponseInterface;

class Caraousel extends BaseController
{
    protected $imgPath = ROOTPATH . 'assets/upload/caraousel/';
    public function index()
    {
        $CaraouselModel = new CaraouselModel();
        $caraousel = $CaraouselModel->findAll();
        return view('admin/caraousel_index', ['caraousel' => $caraousel]);
    }
    public function saveCaraousel()
    {
        $validationRule = [
            'foto' => [
                'label' => 'Foto',
                'rules' => [
                    'uploaded[foto]',
                    'is_image[foto]',
                ],
            ],
        ];
        $validated = $this->validate($validationRule);
        if (!$validated) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $img = $this->request->getFile('foto');
        if (!$img->hasMoved()) {
            $newName = date('Y-m-d-H-i-s') . '.' . $img->getExtension();
            $img->move($this->imgPath, $newName);

        } else {
            return redirect()->back()->with('errors', 'The file has already been moved.');
        }
        $data = [
            'judul' => $this->request->getVar("judul"),
            'foto' => $newName,
        ];
        $CaraouselModel = new CaraouselModel();
        $CaraouselModel->save($data);
        return redirect()->back()->with('success', 'berhasil menambah caraousel');
    }
    public function deleteCaraousel($id)
    {
        $CaraouselModel = new CaraouselModel();
        $caraousel = $CaraouselModel->find($id);
        if ($caraousel) {
            if (file_exists($this->imgPath . $caraousel['foto'])) {
                unlink($this->imgPath . $caraousel['foto']);
            }
            $CaraouselModel->delete($id);
            return redirect()->back()->with('success', 'berhasil menghapus data');
        } else {
            return redirect()->back()->with('error', 'caraousel tidak ditemukan');
        }
    }
    public function editCaraousel($id)
    {
        $CaraouselModel = new CaraouselModel();
        $oldData = $CaraouselModel->find($id);
        $validationRule = [
            'foto' => [
                'label' => 'Foto',
                'rules' => [
                    'uploaded[foto]',
                    'is_image[foto]',
                ],
            ],
        ];
        $validated = $this->validate($validationRule);
        if (!$validated) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $img = $this->request->getFile('foto');
        if (!$img->hasMoved()) {
            if (file_exists($this->imgPath . $oldData['foto'])) {
                unlink($this->imgPath . $oldData['foto']);
            }
            $newName = date('Y-m-d-H-i-s') . '.' . $img->getExtension();
            $img->move($this->imgPath, $newName);
        } else {
            return redirect()->back()->with('errors', 'The file has already been moved.');
        }
        $data = [
            'judul' => $this->request->getVar("judul"),
            'foto' => $newName,
        ];
        $CaraouselModel = new CaraouselModel();
        $CaraouselModel->update($id, $data);
        return redirect()->back()->with('success', 'berhasil menambah caraousel');
    }
}
