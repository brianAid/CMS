<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{

    public function loginView()
    {
        return view("Login");
    }
    public function registerView()
    {
        return view("Register");
    }
    public function login()
    {
        $Username = $this->request->getPost('username');
        $password = md5($this->request->getPost('password'));
        $model = new UserModel();
        $user = $model->where('username', $Username)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Username Tidak ditemukan.');
        } else {
            if ($password != $user['password']) {
                return redirect()->back()->with('error', message: 'password salah.');
            }
            session()->set([
                'username' => $user['username'],
                'role' => $user['level'],
                'isLoggedIn' => true
            ]);

            return redirect()->to('/admin');
        }
    }
    public function register()
    {
        $Username = $this->request->getPost('username');
        $Nama = $this->request->getPost('name');
        $password = md5(string: $this->request->getPost('password'));
        $password2 = md5(string: $this->request->getPost('password2'));
        $model = new UserModel();
        if ($password != $password2) {
            return redirect()->back()->with('error', message: 'Password tidak sama.');
        }
        $data = [
            'username' => $Username,
            'nama' => $Nama,
            'password' => $password,
            'level' => 'Kontributor'
        ];
        $user = $model->save($data);
        if (!$user) {
            return redirect()->back()->with('errors', $model->errors());
        } else {
            return redirect()->to('/login')->with('success', 'berhasil Membuat akun');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
