<?php

namespace App\Controllers;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\Employee;
use App\Models\User;

class AdminController extends BaseController
{
    protected $employeeModel;
    protected $assetModel;
    protected $assignmentModel;
    protected $userModel;

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);

        $this->employeeModel = new Employee();
        $this->assetModel = new Asset();
        $this->assignmentModel = new AssetAssignment();
        $this->userModel = new User();
    }

    public function index()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $search = $this->request->getGet('search') ?? '';
        $assetType = $this->request->getGet('asset_type') ?? '';
        $assetStatus = $this->request->getGet('asset_status') ?? '';
        $editEmployeeId = $this->request->getGet('edit_employee');
        $editAssetId = $this->request->getGet('edit_asset');

        $employees = $this->employeeModel
            ->select('employees.*, users.name as user_name')
            ->join('users', 'users.id = employees.user_id', 'left')
            ->like('employee_name', $search)
            ->orLike('department', $search)
            ->orLike('designation', $search)
            ->orLike('users.name', $search)
            ->orderBy('employees.id', 'DESC')
            ->paginate(8, 'employees');

        $assets = $this->assetModel
            ->like('name', $search)
            ->orLike('type', $search)
            ->orLike('serial_number', $search)
            ->when($assetType !== '', function ($builder) use ($assetType) {
                $builder->where('type', $assetType);
            })
            ->when($assetStatus !== '', function ($builder) use ($assetStatus) {
                $builder->where('status', $assetStatus);
            })
            ->orderBy('id', 'DESC')
            ->paginate(8, 'assets');

        $assignments = $this->assignmentModel
            ->select('asset_assignments.*, employees.employee_name, assets.name as asset_name, assets.type as asset_type, assets.serial_number')
            ->join('employees', 'employees.id = asset_assignments.employee_id', 'left')
            ->join('assets', 'assets.id = asset_assignments.asset_id', 'left')
            ->orderBy('asset_assignments.id', 'DESC')
            ->paginate(8, 'assignments');

        $employeePager = $this->employeeModel->pager;
        $assetPager = $this->assetModel->pager;
        $assignmentPager = $this->assignmentModel->pager;

        return view('admin/dashboard', [
            'employees' => $employees,
            'assets' => $assets,
            'assignments' => $assignments,
            'employeePager' => $employeePager,
            'assetPager' => $assetPager,
            'assignmentPager' => $assignmentPager,
            'users' => $this->userModel->where('role', 'employee')->findAll(),
            'editEmployee' => $editEmployeeId ? $this->employeeModel->find($editEmployeeId) : null,
            'editAsset' => $editAssetId ? $this->assetModel->find($editAssetId) : null,
            'stats' => [
                'employees' => $this->employeeModel->countAllResults(),
                'assets' => $this->assetModel->countAllResults(),
                'assigned' => $this->assignmentModel->where('status', 'assigned')->countAllResults(),
                'returned' => $this->assignmentModel->where('status', 'returned')->countAllResults(),
                'available' => $this->assetModel->where('status', 'available')->countAllResults(),
            ],
            'search' => $search,
            'assetType' => $assetType,
            'assetStatus' => $assetStatus,
        ]);
    }

    public function saveEmployee()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $id = $this->request->getPost('id');
        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'employee_name' => $this->request->getPost('employee_name'),
            'department' => $this->request->getPost('department'),
            'designation' => $this->request->getPost('designation'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
        ];

        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $uploadPath = WRITEPATH . 'uploads';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $newName = $photo->getRandomName();
            $photo->move($uploadPath, $newName);
            $data['photo'] = $newName;
        }

        if ($id) {
            $this->employeeModel->update($id, $data);
            return redirect()->to('/admin_dashboard')->with('message', 'Employee updated successfully.');
        }

        $this->employeeModel->insert($data);
        return redirect()->to('/admin_dashboard')->with('message', 'Employee created successfully.');
    }

    public function deleteEmployee($id)
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $this->employeeModel->delete($id);
        return redirect()->to('/admin_dashboard')->with('message', 'Employee moved to trash.');
    }

    public function saveAsset()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $id = $this->request->getPost('id');
        $data = [
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type'),
            'serial_number' => $this->request->getPost('serial_number'),
            'status' => $this->request->getPost('status'),
            'purchase_date' => $this->request->getPost('purchase_date'),
            'notes' => $this->request->getPost('notes'),
        ];

        if ($id) {
            $this->assetModel->update($id, $data);
            return redirect()->to('/admin_dashboard')->with('message', 'Asset updated successfully.');
        }

        $this->assetModel->insert($data);
        return redirect()->to('/admin_dashboard')->with('message', 'Asset created successfully.');
    }

    public function deleteAsset($id)
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $this->assetModel->delete($id);
        return redirect()->to('/admin_dashboard')->with('message', 'Asset moved to trash.');
    }

    public function assignAsset()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $assetId = $this->request->getPost('asset_id');
        $employeeId = $this->request->getPost('employee_id');
        $notes = $this->request->getPost('notes');

        $activeAssignment = $this->assignmentModel->where('asset_id', $assetId)->where('status', 'assigned')->first();
        if ($activeAssignment) {
            return redirect()->to('/admin_dashboard')->with('error', 'This asset is already assigned.');
        }

        $this->assignmentModel->insert([
            'employee_id' => $employeeId,
            'asset_id' => $assetId,
            'assigned_at' => date('Y-m-d H:i:s'),
            'status' => 'assigned',
            'notes' => $notes,
        ]);

        $this->assetModel->update($assetId, ['status' => 'assigned']);

        return redirect()->to('/admin_dashboard')->with('message', 'Asset assigned successfully.');
    }

    public function returnAsset($id)
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $this->assignmentModel->update($id, [
            'status' => 'returned',
            'returned_at' => date('Y-m-d H:i:s'),
        ]);

        $assignment = $this->assignmentModel->find($id);
        if ($assignment) {
            $this->assetModel->update($assignment['asset_id'], ['status' => 'available']);
        }

        return redirect()->to('/admin_dashboard')->with('message', 'Asset returned successfully.');
    }
}
