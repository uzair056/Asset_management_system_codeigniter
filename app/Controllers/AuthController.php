<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends BaseController
{
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new User();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Invalid email address.');
        }

        $storedPassword = $user['password'];
        $passwordValid = password_verify($password, $storedPassword) || $password === $storedPassword;

        if (!$passwordValid) {
            return redirect()->back()->withInput()->with('error', 'Invalid password.');
        }

        $this->session->set([
            'user_id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'isLoggedIn' => true,
        ]);

        if ($user['role'] === 'admin') {
            return redirect()->to('/admin_dashboard');
        }

        return redirect()->to('/user_dashboard');
    }

    public function logout()
    {
        $this->session->destroy();

        return redirect()->to('/login')->with('message', 'You have been logged out.');
    }
}
