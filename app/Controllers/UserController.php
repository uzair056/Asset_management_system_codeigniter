<?php

namespace App\Controllers;

use App\Models\AssetAssignment;
use App\Models\Employee;
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
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'employee',
        ];

        if ($userModel->insert($data) === false) {
            return redirect()->back()->withInput()->with('errors', $userModel->errors());
        }

        $employeeModel = new Employee();
        $employeeModel->insert([
            'user_id' => $userModel->getInsertID(),
            'employee_name' => $this->request->getPost('name'),
            'department' => 'Unassigned',
            'designation' => 'Employee',
            'email' => $this->request->getPost('email'),
        ]);

        return redirect()->to('/login')->with('success', 'Registration successful. Please login.');
    }

    public function getEmployeeUsers()
    {
        $userModel = new User();

        $employees = $userModel->where('role', 'employee')->findAll();

        return $this->response->setJSON($employees);
    }

    public function index()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $employeeModel = new Employee();
        $assignmentModel = new AssetAssignment();
        $employee = $employeeModel->where('user_id', $this->session->get('user_id'))->first();

        $assignments = [];
        if ($employee) {
            $assignments = $assignmentModel
                ->select('asset_assignments.*, assets.name as asset_name, assets.type as asset_type, assets.serial_number')
                ->join('assets', 'assets.id = asset_assignments.asset_id', 'left')
                ->where('asset_assignments.employee_id', $employee['id'])
                ->orderBy('asset_assignments.id', 'DESC')
                ->findAll();
        }

        return view('users/employee_dashboard', ['employee' => $employee, 'assignments' => $assignments]);
    }
}
