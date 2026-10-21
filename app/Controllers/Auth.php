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
    // 1. Definir reglas de validación obligatorias
    $reglas = [
        'nombre'   => 'required|min_length[3]',
        'email'    => 'required|valid_email',
        'password' => 'required|min_length[6]'
    ];

    // 2. Validar los datos del POST
    if (!$this->validate($reglas)) {
        // Si falla, volvés a la vista mostrando los errores
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // 3. Si pasa la validación, tomamos los datos de forma segura
    $model = new UserModel();

    $nombre   = $this->request->getPost('nombre');
    $email    = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    // 4. Insertar en la base de datos
    $model->insert([
        'nombre'   => $nombre,
        'email'    => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
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

        if ($usuario && password_verify($password, $usuario['password'])) {

            session()->set([
                'id'       => $usuario['id_usuario'],
                'nombre'   => $usuario['nombre'],
                'email'    => $usuario['email'],
                'logueado' => true
            ]);

            return redirect()->to('/index');
        }

        return redirect()->back()->with('error', 'Email o contraseña incorrectos');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/');
    }
}
