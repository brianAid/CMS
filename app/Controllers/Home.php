<?php

namespace App\Controllers;

use App\Models\CaraouselModel;
use App\Models\KategoriModel;
use App\Models\KonfigurasiModel;
use App\Models\KontenModel;

class Home extends BaseController
{
    public function index()
    {
        $KontenModel = new KontenModel();
        $konten = $KontenModel->join('kategori', 'konten.id_kategori = kategori.id_kategori')->orderBy('konten.id_konten', 'DESC')->findAll();
        $KategoriModel = new KategoriModel();
        $kategori = $KategoriModel->findAll();
        $CaraouselModel = new CaraouselModel();
        $caraousel = $CaraouselModel->findAll();
        $KonfigurasiModel = new KonfigurasiModel();
        $konfigurasi = $KonfigurasiModel->first();

        return view('Beranda', ['konten' => $konten, 'kategori' => $kategori, 'caraousel' => $caraousel, 'konfigurasi' => $konfigurasi]);
    }
    public function blog($slug)
    {
        $KonfigurasiModel = new KonfigurasiModel();
        $konfigurasi = $KonfigurasiModel->first();
        $KategoriModel = new KategoriModel();
        $kategori = $KategoriModel->findAll();
        $KontenModel = new KontenModel();
        $konten = $KontenModel->join('kategori', 'konten.id_kategori = kategori.id_kategori')->where('slug', $slug)->first();
        $recentKonten = $KontenModel->limit(4)->findAll();
        return view('Blog', ['recentKonten' => $recentKonten, 'konten' => $konten, 'kategori' => $kategori, 'konfigurasi' => $konfigurasi]);
    }
    public function sortKategori($id)
    {
        $CaraouselModel = new CaraouselModel();
        $caraousel = $CaraouselModel->findAll();
        $KonfigurasiModel = new KonfigurasiModel();
        $konfigurasi = $KonfigurasiModel->first();
        $KategoriModel = new KategoriModel();
        $kategori = $KategoriModel->findAll();
        $KontenModel = new KontenModel();
        $konten = $KontenModel->
            join('kategori', 'konten.id_kategori = kategori.id_kategori')->
            where('konten.id_kategori', $id)->orderBy('konten.id_konten', 'DESC')
            ->findAll();
        return view('beranda', data: ['caraousel' => $caraousel, 'konten' => $konten, 'kategori' => $kategori, 'konfigurasi' => $konfigurasi]);
    }
}
