<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\User;

class UserController extends BaseController
{
    public function show_register()
    {
        return view('login_register/register');
    }
    public function show_login()
    {
        return view('login_register/login');
    }

    public function register()
    {
        $userModel = new User();

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role'     => 'employee'
        ];

        if ($userModel->insert($data) === false) {
            return redirect()->back()->withInput()->with('errors', $userModel->errors());
        }

        return redirect()->to('/login')->with('success', 'Registration successful. Please login.');
    }



    public function getEmployeeUsers()
    {
        $userModel = new User();

        $employees = $userModel
            ->where('role', 'employee')
            ->findAll();

        return $this->response->setJSON($employees);
    }

    public function index()
    {
        return view('users/dashboard');
    }
}
