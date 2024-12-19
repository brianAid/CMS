<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CaraouselModel;
use App\Models\KategoriModel;
use App\Models\KonfigurasiModel;
use App\Models\KontenModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Json extends BaseController
{
    public function getUser($id)
    {
        $model = new UserModel();
        $user = $model->find($id);
        return $this->response
            ->setStatusCode(200)
            ->setJSON($user);
    }
    public function getKategori($id)
    {
        $id = intval($id);
        $model = new KategoriModel();
        $kategori = $model->find($id);
        return $this->response
            ->setStatusCode(200)
            ->setJSON($kategori);
    }
    public function getKonten($id)
    {
        $model = new KontenModel();
        $konten = $model->find($id);
        return $this->response
            ->setStatusCode(200)
            ->setJSON($konten);
    }
    public function getKonfigurasi($id)
    {
        $model = new KonfigurasiModel();
        $konfigurasi = $model->find($id);
        return $this->response
            ->setStatusCode(200)
            ->setJSON($konfigurasi);
    }
    public function getCaraousel($id)
    {
        $model = new CaraouselModel();
        $caraousel = $model->find($id);
        return $this->response
            ->setStatusCode(200)
            ->setJSON($caraousel);
    }
}
