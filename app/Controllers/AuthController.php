<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

class AuthController extends ResourceController
{
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new User();

        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return $this->respond([
                'status' => false,
                'message' => 'Invalid email.'
            ], 401);
        }

        // Abhi plain password check kar rahe hain
        if ($password != $user['password']) {
            return $this->respond([
                'status' => false,
                'message' => 'Invalid password.'
            ], 401);
        }

        $secret = env('JWT_SECRET');

        $payload = [
            'iss' => base_url(),
            'aud' => base_url(),
            'iat' => time(),
            'exp' => time() + 900, // 15 minutes
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ]
        ];

        $token = JWT::encode($payload, $secret, 'HS256');

        return $this->respond([
            'status' => true,
            'message' => 'Login Successful',
            'token' => $token
        ]);
    }
}
