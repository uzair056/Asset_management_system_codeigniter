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
        $assignmentStatus = $this->request->getGet('assignment_status') ?? '';
        $editEmployeeId = $this->request->getGet('edit_employee');
        $editAssetId = $this->request->getGet('edit_asset');

        $employeeBuilder = $this->employeeModel
            ->select('employees.*, users.name as user_name')
            ->join('users', 'users.id = employees.user_id', 'left');

        if ($search !== '') {
            $employeeBuilder
                ->groupStart()
                ->like('employees.employee_name', $search)
                ->orLike('employees.department', $search)
                ->orLike('employees.designation', $search)
                ->orLike('users.name', $search)
                ->groupEnd();
        }

        $employees = $employeeBuilder
            ->orderBy('employees.id', 'DESC')
            ->paginate(8, 'employees');

        $assetBuilder = $this->assetModel;
        if ($search !== '') {
            $assetBuilder
                ->groupStart()
                ->like('name', $search)
                ->orLike('type', $search)
                ->orLike('serial_number', $search)
                ->groupEnd();
        }
        if ($assetType !== '') {
            $assetBuilder->where('type', $assetType);
        }
        if ($assetStatus !== '') {
            $assetBuilder->where('status', $assetStatus);
        }

        $assets = $assetBuilder
            ->orderBy('id', 'DESC')
            ->paginate(8, 'assets');

        $assignmentBuilder = $this->assignmentModel
            ->select('asset_assignments.*, employees.employee_name, assets.name as asset_name, assets.type as asset_type, assets.serial_number')
            ->join('employees', 'employees.id = asset_assignments.employee_id', 'left')
            ->join('assets', 'assets.id = asset_assignments.asset_id', 'left')
            ->orderBy('asset_assignments.id', 'DESC');

        if ($search !== '') {
            $assignmentBuilder
                ->groupStart()
                ->like('employees.employee_name', $search)
                ->orLike('assets.name', $search)
                ->orLike('assets.type', $search)
                ->orLike('assets.serial_number', $search)
                ->groupEnd();
        }
        if ($assignmentStatus !== '') {
            $assignmentBuilder->where('asset_assignments.status', $assignmentStatus);
        }

        $assignments = $assignmentBuilder->paginate(8, 'assignments');

        $employeePager = $this->employeeModel->pager;
        $assetPager = $this->assetModel->pager;
        $assignmentPager = $this->assignmentModel->pager;

        $assignableEmployees = $this->employeeModel
            ->select('employees.id, employees.employee_name')
            ->orderBy('employees.employee_name', 'ASC')
            ->findAll();

        $availableAssets = $this->assetModel
            ->where('status', 'available')
            ->orderBy('name', 'ASC')
            ->findAll();

        return view('admin/dashboard', [
            'employees' => $employees,
            'assets' => $assets,
            'assignments' => $assignments,
            'employeePager' => $employeePager,
            'assetPager' => $assetPager,
            'assignmentPager' => $assignmentPager,
            'users' => $this->userModel->where('role', 'employee')->findAll(),
            'assignableEmployees' => $assignableEmployees,
            'availableAssets' => $availableAssets,
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
            'assignmentStatus' => $assignmentStatus,
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

        $assetId = (int) $this->request->getPost('asset_id');
        $employeeId = (int) $this->request->getPost('employee_id');
        $notes = $this->request->getPost('notes');

        if (!$assetId || !$employeeId) {
            return redirect()->to('/admin_dashboard')->with('error', 'Please select both employee and asset.');
        }

        $employee = $this->employeeModel->find($employeeId);
        if (!$employee) {
            return redirect()->to('/admin_dashboard')->with('error', 'Selected employee was not found.');
        }

        $asset = $this->assetModel->find($assetId);
        if (!$asset) {
            return redirect()->to('/admin_dashboard')->with('error', 'Selected asset was not found.');
        }
        if (($asset['status'] ?? '') !== 'available') {
            return redirect()->to('/admin_dashboard')->with('error', 'Only available assets can be assigned.');
        }

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

    public function exportAssignmentsReport()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $assignmentStatus = $this->request->getGet('assignment_status') ?? '';
        $search = $this->request->getGet('search') ?? '';

        $builder = $this->assignmentModel
            ->select('asset_assignments.*, employees.employee_name, assets.name as asset_name, assets.type as asset_type, assets.serial_number')
            ->join('employees', 'employees.id = asset_assignments.employee_id', 'left')
            ->join('assets', 'assets.id = asset_assignments.asset_id', 'left')
            ->orderBy('asset_assignments.id', 'DESC');

        if ($assignmentStatus !== '') {
            $builder->where('asset_assignments.status', $assignmentStatus);
        }

        if ($search !== '') {
            $builder
                ->groupStart()
                ->like('employees.employee_name', $search)
                ->orLike('assets.name', $search)
                ->orLike('assets.type', $search)
                ->orLike('assets.serial_number', $search)
                ->groupEnd();
        }

        $rows = $builder->findAll();
        $filename = 'assignment_report_' . date('Ymd_His') . '.csv';

        $handle = fopen('php://temp', 'w+');
        fputcsv($handle, ['Employee', 'Asset', 'Type', 'Serial Number', 'Assigned At', 'Returned At', 'Status', 'Notes']);
        foreach ($rows as $row) {
            fputcsv($handle, [
                $row['employee_name'] ?? '',
                $row['asset_name'] ?? '',
                $row['asset_type'] ?? '',
                $row['serial_number'] ?? '',
                $row['assigned_at'] ?? '',
                $row['returned_at'] ?? '',
                $row['status'] ?? '',
                $row['notes'] ?? '',
            ]);
        }
        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return $this->response
            ->setHeader('Content-Type', 'text/csv')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($csv);
    }
}
