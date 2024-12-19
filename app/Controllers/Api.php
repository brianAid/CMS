<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KontenModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use \Firebase\JWT\JWT;
class Api extends BaseController
{
    protected $imgPath = ROOTPATH . 'assets/upload/konten/';

    use ResponseTrait;
    public function login()
    {
        $Username = $this->request->getVar('username');
        $password = md5($this->request->getVar('password'));
        $model = new UserModel();
        $user = $model->where('username', $Username)->first();
        if (!$user) {
            return $this->respond(['error' => 'Invalid username.'], 401);
        } else {
            if ($password != $user['password']) {
                return $this->respond(['error' => 'Invalid password.'], 401);
            }

            $key = getenv('JWT_SECRET');
            $iat = time();
            $exp = $iat + 3600;

            $payload = array(
                "iss" => "Issuer of the JWT",
                "aud" => "Audience that the JWT",
                "sub" => "Subject of the JWT",
                "iat" => $iat,
                "exp" => $exp,
            );
            $token = JWT::encode($payload, $key, 'HS256');

            $response = [
                'message' => 'Login Succesful',
                'token' => $token
            ];

            return $this->respond($response, 200);
        }
    }
    public function getKonten()
    {
        $kontenModel = new KontenModel();
        $konten = $kontenModel->findAll();
        return $this->response->setJSON($konten);
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
            return $this->respond(['error' => $this->validator->getErrors()], 401);
        }

        $img = $this->request->getFile('foto');
        if (!$img->hasMoved()) {
            $DateTime = date('Y-m-d');
            $newName = date('Y-m-d-H-i-s') . $img->getClientName();
            $img->move($this->imgPath, $newName);

        } else {
            return $this->respond(['error' => 'The file has already been moved.'], 401);
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
        return $this->respond(['success' => 'berhasil menambah konten.'], 200);
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
            return $this->respond(['success' => 'berhasil menghapus data.'], 200);
        } else {
            return $this->respond(['error' => 'Konten Tidak Ditemukan.'], 401);
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
                return $this->respond(['error' => $this->validator->getErrors()], 401);
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
            return $this->respond(['error' => 'Gambar Tidak Ditemukan.'], 401);
        } else {
            $data = [
                'judul' => $this->request->getVar("judul"),
                'keterangan' => $this->request->getVar("keterangan"),
                'id_kategori' => $this->request->getVar("id_kategori"),
                'slug' => str_replace(' ', '-', $this->request->getVar('judul')),
                'tanggal' => $DateTime,
                'username' => session()->get(key: 'username')
            ];
        }
        $KontenModel = new KontenModel();
        $KontenModel->update($id, $data);
        return $this->respond(['success' => 'berhasil Mengedit Konten.'], 200);
    }
}