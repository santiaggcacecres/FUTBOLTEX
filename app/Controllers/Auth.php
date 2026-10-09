<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function guardarRegistro()
    {
        $model = new UserModel();

        $nombre = $this->request->getPost('nombre');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Se cambia la clave 'password' por 'password_hash' para la BD
        $model->insert([
            'nombre'        => $nombre,
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/login');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function iniciarSesion()
    {
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $usuario = $model->where('email', $email)->first();

        if ($usuario && password_verify($password, $usuario['password_hash'])) {

            session()->set([
                'id'       => $usuario['id_usuario'],
                'nombre'   => $usuario['nombre'],
                'email'    => $usuario['email'],
                'logueado' => true
            ]);

            return redirect()->to('/home');
        }

        return redirect()->back()->with('error', 'Email o contraseña incorrectos');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
