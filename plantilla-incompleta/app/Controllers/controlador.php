<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function saveRegister()
    {
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Verificar si el email ya existe
        $existingUser = $model
            ->where('email', $email)
            ->first();

        if ($existingUser) {
            return redirect()
                ->back()
                ->with('error', 'El email ya está registrado.');
        }

        // Crear usuario
        $model->insert([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        return redirect()
            ->to('/login')
            ->with('success', 'Usuario registrado correctamente.');
    }

    public function authenticate()
    {
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Buscar usuario por email
        $user = $model
            ->where('email', $email)
            ->first();

        // Verificar usuario y contraseña
        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()
                ->back()
                ->with('error', 'Email o contraseña incorrectos.');
        }

        // Crear sesión
        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'isLoggedIn' => true
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()
            ->to('/login')
            ->with('success', 'Sesión cerrada correctamente.');
    }
}
