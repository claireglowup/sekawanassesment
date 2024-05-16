<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{
    protected $adminModel;
    public function __construct()
    {
        $this->adminModel = new UsersModel();
    }

    public function login()
    {


        try {
            $username = $this->request->getPost("username");
            $password = $this->request->getPost("password");

            $user = $this->adminModel->where('username', $username)->first();


            if ($user) {
                if (password_verify(strval($password), $user['password'])) {
                    $session = session();
                    $session->set('isLoggedIn', true);
                    $session->set('userId', $user['id']);
                    $session->set('authorization', $user["username"]);
                    $session->set("role", $user["role"]);

                    return redirect()->to('/');
                } else {
                    session()->setFlashdata('password', "Password Salah");
                    session()->setFlashdata('usernameV', $username);
                    session()->setFlashdata('passwordV', $password);

                    session()->remove('username');

                    return view('pages/home', ['title' => "Home"]);
                }
            } else {
                session()->setFlashdata('username', "username tidak ditemukan");
                session()->setFlashdata('usernameV', $username);
                session()->setFlashdata('passwordV', $password);

                return view('pages/home', ['title' => "Home"]);
            }
        } catch (\Exception $e) {
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
