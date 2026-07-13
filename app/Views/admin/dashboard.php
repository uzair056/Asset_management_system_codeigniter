<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard · Employee Asset Management</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    :root { color-scheme: light; }
    * { box-sizing: border-box; }
    body { margin: 0; font-family: 'Inter', sans-serif; background: #f4f7fb; color: #14213d; }
    a { color: inherit; text-decoration: none; }
    .wrap { max-width: 1400px; margin: 0 auto; padding: 24px; }
    .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .topbar h1 { margin: 0; font-size: 28px; }
    .topbar p { margin: 4px 0 0; color: #64748b; }
    .pill { display: inline-flex; align-items: center; gap: 8px; padding: 10px 14px; border-radius: 999px; background: #fff; border: 1px solid #e2e8f0; }
    .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 20px; }
    .card { background: #fff; border-radius: 18px; padding: 16px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06); }
    .stat { display: flex; justify-content: space-between; align-items: center; }
    .stat .value { font-size: 24px; font-weight: 700; }
    .grid { display: grid; gap: 20px; grid-template-columns: 1.1fr 0.9fr; }
    .panel { background: #fff; border-radius: 18px; padding: 18px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06); }
    .panel h3 { margin-top: 0; margin-bottom: 12px; }
    .row { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 12px; }
    .form-grid { display: grid; gap: 12px; grid-template-columns: repeat(2, minmax(0, 1fr)); }
    label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #475569; }
    input, select, textarea, button { font: inherit; }
    input, select, textarea { width: 100%; padding: 10px 12px; border: 1px solid #dbe3ee; border-radius: 10px; background: #f9fbff; }
    button { border: none; padding: 10px 14px; border-radius: 10px; cursor: pointer; }
    .btn-primary { background: #4338ca; color: #fff; }
    .btn-danger { background: #ef4444; color: #fff; }
    .btn-secondary { background: #e2e8f0; color: #0f172a; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { text-align: left; padding: 10px 8px; border-bottom: 1px solid #eef2f7; font-size: 14px; }
    th { color: #64748b; font-weight: 600; }
    .badge { display: inline-block; padding: 6px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; }
    .badge.assigned { background: #ecfeff; color: #0f766e; }
    .badge.returned { background: #ecfdf3; color: #166534; }
    .badge.available { background: #fef3c7; color: #b45309; }
    .actions a { margin-right: 8px; font-size: 13px; }
    .muted { color: #64748b; font-size: 13px; }
    .flash { padding: 12px 14px; border-radius: 10px; margin-bottom: 14px; background: #ecfdf3; color: #166534; }
    .flash.error { background: #fef2f2; color: #b91c1c; }
    .pager { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 10px; }
    .pager a { padding: 6px 10px; border-radius: 8px; background: #eef2ff; }
    @media (max-width: 960px) { .grid { grid-template-columns: 1fr; } }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="topbar">
      <div>
        <h1>Employee Asset Management</h1>
        <p>Admin dashboard for employees, assets, assignment and return tracking.</p>
      </div>
      <a class="pill" href="<?= site_url('logout') ?>"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

    <?php if (session()->getFlashdata('message')): ?><div class="flash"><?= esc(session()->getFlashdata('message')) ?></div><?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?><div class="flash error"><?= esc(session()->getFlashdata('error')) ?></div><?php endif; ?>

    <div class="stats">
      <div class="card stat"><div><div class="muted">Employees</div><div class="value"><?= esc($stats['employees']) ?></div></div><i class="fa-solid fa-users"></i></div>
      <div class="card stat"><div><div class="muted">Assets</div><div class="value"><?= esc($stats['assets']) ?></div></div><i class="fa-solid fa-laptop"></i></div>
      <div class="card stat"><div><div class="muted">Assigned</div><div class="value"><?= esc($stats['assigned']) ?></div></div><i class="fa-solid fa-box-open"></i></div>
      <div class="card stat"><div><div class="muted">Returned</div><div class="value"><?= esc($stats['returned']) ?></div></div><i class="fa-solid fa-rotate-left"></i></div>
      <div class="card stat"><div><div class="muted">Available</div><div class="value"><?= esc($stats['available']) ?></div></div><i class="fa-solid fa-check-circle"></i></div>
    </div>

    <div class="grid">
      <div class="panel">
        <h3><i class="fa-solid fa-users"></i> Employee Management</h3>
        <form action="<?= site_url('admin/employees/save') ?>" method="post" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <input type="hidden" name="id" value="<?= esc($editEmployee['id'] ?? '') ?>">
          <div class="form-grid">
            <div><label>User</label><select name="user_id"><option value="">Select account</option><?php foreach ($users as $user): ?><option value="<?= esc($user['id']) ?>" <?= ($editEmployee['user_id'] ?? '') == $user['id'] ? 'selected' : '' ?>><?= esc($user['name']) ?></option><?php endforeach; ?></select></div>
            <div><label>Employee Name</label><input type="text" name="employee_name" value="<?= esc($editEmployee['employee_name'] ?? '') ?>" required></div>
            <div><label>Department</label><input type="text" name="department" value="<?= esc($editEmployee['department'] ?? '') ?>"></div>
            <div><label>Designation</label><input type="text" name="designation" value="<?= esc($editEmployee['designation'] ?? '') ?>"></div>
            <div><label>Email</label><input type="email" name="email" value="<?= esc($editEmployee['email'] ?? '') ?>"></div>
            <div><label>Phone</label><input type="text" name="phone" value="<?= esc($editEmployee['phone'] ?? '') ?>"></div>
            <div><label>Photo</label><input type="file" name="photo"></div>
          </div>
          <div class="row" style="margin-top: 12px;"><button class="btn-primary" type="submit">Save Employee</button><a class="btn-secondary" href="<?= site_url('admin_dashboard') ?>" style="display:inline-block;">Reset</a></div>
        </form>
        <div class="row" style="margin-top: 16px;">
          <form action="<?= site_url('admin_dashboard') ?>" method="get" style="display:flex; gap:8px; flex:1;">
            <input type="text" name="search" value="<?= esc($search) ?>" placeholder="Search employees or department">
            <button class="btn-secondary" type="submit">Search</button>
          </form>
        </div>
        <table>
          <thead><tr><th>Name</th><th>Department</th><th>Designation</th><th>Actions</th></tr></thead>
          <tbody>
            <?php foreach ($employees as $employee): ?>
              <tr>
                <td><?= esc($employee['employee_name']) ?></td>
                <td><?= esc($employee['department']) ?></td>
                <td><?= esc($employee['designation']) ?></td>
                <td class="actions"><a href="<?= site_url('admin_dashboard?edit_employee=' . $employee['id']) ?>">Edit</a><a href="<?= site_url('admin/employees/delete/' . $employee['id']) ?>" class="btn-danger" style="padding: 4px 8px; border-radius: 8px;">Delete</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="pager"><?= $employeePager->links() ?></div>
      </div>

      <div class="panel">
        <h3><i class="fa-solid fa-laptop"></i> Asset Management</h3>
        <form action="<?= site_url('admin/assets/save') ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="id" value="<?= esc($editAsset['id'] ?? '') ?>">
          <div class="form-grid">
            <div><label>Asset Name</label><input type="text" name="name" value="<?= esc($editAsset['name'] ?? '') ?>" required></div>
            <div><label>Type</label><select name="type"><option value="Laptop" <?= (($editAsset['type'] ?? '') == 'Laptop') ? 'selected' : '' ?>>Laptop</option><option value="Mouse" <?= (($editAsset['type'] ?? '') == 'Mouse') ? 'selected' : '' ?>>Mouse</option><option value="Monitor" <?= (($editAsset['type'] ?? '') == 'Monitor') ? 'selected' : '' ?>>Monitor</option><option value="Phone" <?= (($editAsset['type'] ?? '') == 'Phone') ? 'selected' : '' ?>>Phone</option></select></div>
            <div><label>Serial Number</label><input type="text" name="serial_number" value="<?= esc($editAsset['serial_number'] ?? '') ?>"></div>
            <div><label>Status</label><select name="status"><option value="available" <?= (($editAsset['status'] ?? '') == 'available') ? 'selected' : '' ?>>Available</option><option value="assigned" <?= (($editAsset['status'] ?? '') == 'assigned') ? 'selected' : '' ?>>Assigned</option></select></div>
            <div><label>Purchase Date</label><input type="date" name="purchase_date" value="<?= esc($editAsset['purchase_date'] ?? '') ?>"></div>
            <div><label>Notes</label><input type="text" name="notes" value="<?= esc($editAsset['notes'] ?? '') ?>"></div>
          </div>
          <div class="row" style="margin-top: 12px;"><button class="btn-primary" type="submit">Save Asset</button><a class="btn-secondary" href="<?= site_url('admin_dashboard') ?>" style="display:inline-block;">Reset</a></div>
        </form>
        <form action="<?= site_url('admin_dashboard') ?>" method="get" class="row" style="margin-top: 14px;">
          <input type="text" name="search" value="<?= esc($search) ?>" placeholder="Search assets">
          <select name="asset_type"><option value="">All types</option><option value="Laptop" <?= $assetType === 'Laptop' ? 'selected' : '' ?>>Laptop</option><option value="Mouse" <?= $assetType === 'Mouse' ? 'selected' : '' ?>>Mouse</option><option value="Monitor" <?= $assetType === 'Monitor' ? 'selected' : '' ?>>Monitor</option><option value="Phone" <?= $assetType === 'Phone' ? 'selected' : '' ?>>Phone</option></select>
          <select name="asset_status"><option value="">All status</option><option value="available" <?= $assetStatus === 'available' ? 'selected' : '' ?>>Available</option><option value="assigned" <?= $assetStatus === 'assigned' ? 'selected' : '' ?>>Assigned</option></select>
          <button class="btn-secondary" type="submit">Filter</button>
        </form>
        <table>
          <thead><tr><th>Name</th><th>Type</th><th>Status</th><th>Actions</th></tr></thead>
          <tbody>
            <?php foreach ($assets as $asset): ?>
              <tr>
                <td><?= esc($asset['name']) ?></td>
                <td><?= esc($asset['type']) ?></td>
                <td><span class="badge <?= esc($asset['status']) ?>"><?= esc(ucfirst($asset['status'])) ?></span></td>
                <td class="actions"><a href="<?= site_url('admin_dashboard?edit_asset=' . $asset['id']) ?>">Edit</a><a href="<?= site_url('admin/assets/delete/' . $asset['id']) ?>" class="btn-danger" style="padding: 4px 8px; border-radius: 8px;">Delete</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="pager"><?= $assetPager->links() ?></div>
      </div>
    </div>

    <div class="grid" style="margin-top: 20px;">
      <div class="panel">
        <h3><i class="fa-solid fa-arrow-right-arrow-left"></i> Asset Assignment</h3>
        <form action="<?= site_url('admin/assignments/assign') ?>" method="post">
          <?= csrf_field() ?>
          <div class="form-grid">
            <div><label>Employee</label><select name="employee_id" required><?php foreach ($users as $user): ?><option value="<?= esc($user['id']) ?>"><?= esc($user['name']) ?></option><?php endforeach; ?></select></div>
            <div><label>Asset</label><select name="asset_id" required><?php foreach ($assets as $asset): ?><option value="<?= esc($asset['id']) ?>"><?= esc($asset['name']) ?> (<?= esc($asset['type']) ?>)</option><?php endforeach; ?></select></div>
          </div>
          <div style="margin-top: 10px;"><label>Notes</label><textarea name="notes" rows="3"></textarea></div>
          <div class="row" style="margin-top: 12px;"><button class="btn-primary" type="submit">Assign Asset</button></div>
        </form>
      </div>

      <div class="panel">
        <h3><i class="fa-solid fa-file-lines"></i> Assignment History & Reports</h3>
        <table>
          <thead><tr><th>Employee</th><th>Asset</th><th>Status</th><th>Action</th></tr></thead>
          <tbody>
            <?php foreach ($assignments as $assignment): ?>
              <tr>
                <td><?= esc($assignment['employee_name']) ?></td>
                <td><?= esc($assignment['asset_name']) ?></td>
                <td><span class="badge <?= esc($assignment['status']) ?>"><?= esc(ucfirst($assignment['status'])) ?></span></td>
                <td>
                  <?php if ($assignment['status'] === 'assigned'): ?>
                    <a href="<?= site_url('admin/assignments/return/' . $assignment['id']) ?>" class="btn-secondary" style="display:inline-block; padding: 4px 8px;">Return</a>
                  <?php else: ?>
                    <span class="muted">Completed</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="pager"><?= $assignmentPager->links() ?></div>
      </div>
    </div>
  </div>
</body>
</html>