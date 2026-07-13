<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard · Employee Asset Management</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; }
    body { margin: 0; font-family: 'Inter', sans-serif; background: #f4f7fb; color: #14213d; }
    .wrap { max-width: 1100px; margin: 0 auto; padding: 24px; }
    .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .card { background: #fff; border-radius: 18px; padding: 20px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06); }
    .profile { display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap; margin-bottom: 20px; }
    .avatar { width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, #4338ca, #6366f1); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700; }
    .muted { color: #64748b; font-size: 13px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { text-align: left; padding: 10px 8px; border-bottom: 1px solid #eef2f7; }
    .badge { display: inline-block; padding: 6px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; background: #ecfeff; color: #0f766e; }
    .badge.returned { background: #ecfdf3; color: #166534; }
    .link { display: inline-block; margin-top: 16px; color: #4338ca; font-weight: 600; }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="topbar">
      <div>
        <h1>My Dashboard</h1>
        <p>See your assigned assets and return history.</p>
      </div>
      <a class="link" href="<?= site_url('logout') ?>">Logout</a>
    </div>

    <div class="card profile">
      <div style="display:flex; align-items:center; gap: 12px;">
        <div class="avatar"><?= esc(substr($employee['employee_name'] ?? $this->session->get('name'), 0, 1)) ?></div>
        <div>
          <h2 style="margin: 0;"><?= esc($employee['employee_name'] ?? $this->session->get('name')) ?></h2>
          <div class="muted"><?= esc($employee['designation'] ?? 'Employee') ?> · <?= esc($employee['department'] ?? 'Unassigned') ?></div>
        </div>
      </div>
      <div class="muted">Email: <?= esc($employee['email'] ?? $this->session->get('email')) ?></div>
    </div>

    <div class="card">
      <h3>Assigned Assets</h3>
      <table>
        <thead><tr><th>Asset</th><th>Type</th><th>Serial</th><th>Status</th><th>Assigned On</th></tr></thead>
        <tbody>
          <?php if (!empty($assignments)): foreach ($assignments as $assignment): ?>
            <tr>
              <td><?= esc($assignment['asset_name']) ?></td>
              <td><?= esc($assignment['asset_type']) ?></td>
              <td><?= esc($assignment['serial_number']) ?></td>
              <td><span class="badge <?= esc($assignment['status']) ?>"><?= esc(ucfirst($assignment['status'])) ?></span></td>
              <td><?= esc($assignment['assigned_at']) ?></td>
            </tr>
          <?php endforeach; else: ?>
            <tr><td colspan="5" class="muted">No assets assigned yet.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
