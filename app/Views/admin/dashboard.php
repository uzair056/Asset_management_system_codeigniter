<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
  <title>Admin Dashboard · Employee Asset Management</title>
  <!-- Google Font Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <!-- Font Awesome 6 for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('css/admin_dashboard.css') ?>">
style>
    /* Additional inline styles can go here if needed */
  </style>
</head>
<body>
  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <div class="icon">📦</div>
      <div class="text">Asset<span>Flow</span></div>
    </div>
    <ul class="nav-menu">
      <li class="nav-item active"><a href="#"><i class="fas fa-th-large"></i> Dashboard</a></li>
      <li class="nav-item"><a href="#"><i class="fas fa-users"></i> Employees</a></li>
      <li class="nav-item"><a href="#"><i class="fas fa-laptop"></i> Assets</a></li>
      <li class="nav-item"><a href="#"><i class="fas fa-undo-alt"></i> Returns</a></li>
      <li class="nav-item"><a href="#"><i class="fas fa-chart-bar"></i> Reports</a></li>
    </ul>
    <div class="sidebar-footer">
      <div class="admin-profile">
        <div class="admin-avatar">AK</div>
        <div class="admin-info">
          <div class="name">Admin Khan</div>
          <div class="role">Super Admin</div>
        </div>
      </div>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="main-content" id="mainContent">
    <!-- Top Bar -->
    <div class="top-bar">
      <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
      <div class="page-title">
        <h1>Employee Overview</h1>
        <p>Manage assets, assignments & returns</p>
      </div>
      <div class="top-actions">
        <div class="search-box">
          <i class="fas fa-search"></i>
          <input type="text" placeholder="Search employees..." id="searchInput">
        </div>
        <button class="btn-outline"><i class="fas fa-download"></i> Export</button>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon employees"><i class="fas fa-user-friends"></i></div>
        <div class="stat-info">
          <div class="number" id="totalEmployees">24</div>
          <div class="label">Total Employees</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon assigned"><i class="fas fa-box"></i></div>
        <div class="stat-info">
          <div class="number" id="totalAssigned">18</div>
          <div class="label">Assets Assigned</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon returned"><i class="fas fa-check-circle"></i></div>
        <div class="stat-info">
          <div class="number" id="totalReturned">6</div>
          <div class="label">Assets Returned</div>
        </div>
      </div>
    </div>

    <!-- Employees Table -->
    <div class="table-card">
      <div class="table-header">
        <h3><i class="fas fa-users" style="color:#4338CA; margin-right:6px;"></i> All Employees</h3>
        <button class="btn-outline"><i class="fas fa-plus"></i> Add Employee</button>
      </div>
      <div class="table-responsive">
        <table id="employeeTable">
          <thead>
            <tr>
              <th>Employee</th>
              <th>Role</th>
              <th>Department</th>
              <th>Assets Assigned</th>
              <th>Asset Return</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Data injected via JS -->
          </tbody>
        </table>
      </div>
    </div>
  </main>

 <script src="<?= base_url('js/admin_dashboard.js') ?>"></script>

</body>
</html>