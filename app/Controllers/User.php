<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {
        helper(['url']);
        if (session()->get('role') != 'Admin'){
            return redirect()->to("admin");
        }
    }
    public function index()
    {
        return view('admin/dashboard');

    }
    public function userview()
    {
        helper('form');
        $UserModel = new UserModel();
        $user = $UserModel->findAll();

        return view('admin/user_index', ['user' => $user]);
    }
    public function saveUser()
    {
        $UserModel = new UserModel();
        $post = [
            'nama' => $this->request->getVar('Nama'),
            'username' => $this->request->getVar('Username'),
            'password' => md5($this->request->getVar('Password')),
            'level' => $this->request->getVar('level')
        ];
        if ($UserModel->save($post) === false) {
            // var_dump($UserModel->errors());
            // die;
            return redirect()->back()->with( 'errors', $UserModel->errors());
        }
        session()->setFlashdata('alert', '
                    <div class="alert alert-success alert-dismissible" role="alert">
                    berhasil menambahkan user
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        ');
        return redirect()->back();
    }
    public function deleteUser($id)
    {
        $UserModel = new UserModel();
        try {
            $UserModel->delete($id);
            return redirect()->back()->with('success', 'berhasil menghapus data');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }
    }
    public function editUser($id)
    {
        $post = [
            'nama' => $this->request->getVar('Nama'),
            'username' => $this->request->getVar('Username'),
            'password' => md5($this->request->getVar('Password')),
            'level' => $this->request->getVar('level')
        ];
        $UserModel = new UserModel();
        $UserModel->update($id,$post);
        if ($UserModel) {
            return redirect()->back()->with('success',  'Berhasil update user');
        } else {
            return redirect()->back()->with('error', 'user tidak ditemukan');
        }
    }

}
