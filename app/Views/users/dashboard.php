<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
  <title>User Dashboard · Employee Asset Management</title>
  <!-- Google Font Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      background-color: #F1F5F9;
      color: #1E293B;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ========== NAVBAR ========== */
    .navbar {
      background: #FFFFFF;
      border-bottom: 1px solid #e2e8f0;
      padding: 0.9rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 2px 12px rgba(0,0,0,0.03);
      flex-wrap: wrap;
      gap: 1rem;
    }

    .nav-brand {
      display: flex;
      align-items: center;
      gap: 0.6rem;
    }

    .nav-brand .brand-icon {
      background: #4338CA;
      width: 38px;
      height: 38px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 1.1rem;
      box-shadow: 0 6px 12px rgba(67,56,202,0.3);
    }

    .nav-brand .brand-text {
      font-weight: 700;
      font-size: 1.25rem;
      color: #1E293B;
    }
    .nav-brand .brand-text span {
      color: #4338CA;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 1.8rem;
      list-style: none;
    }

    .nav-links a {
      text-decoration: none;
      color: #475569;
      font-weight: 500;
      font-size: 0.9rem;
      transition: color 0.2s;
      display: flex;
      align-items: center;
      gap: 0.4rem;
    }

    .nav-links a:hover,
    .nav-links a.active {
      color: #4338CA;
    }

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 1.2rem;
    }

    .notification-bell {
      position: relative;
      cursor: pointer;
      color: #475569;
      font-size: 1.2rem;
    }
    .notification-bell .dot {
      position: absolute;
      top: -4px;
      right: -4px;
      width: 9px;
      height: 9px;
      background: #F59E0B;
      border-radius: 50%;
      border: 2px solid white;
    }

    .user-profile-nav {
      display: flex;
      align-items: center;
      gap: 0.6rem;
      cursor: pointer;
    }
    .user-avatar-nav {
      width: 38px;
      height: 38px;
      background: #6366F1;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 600;
      font-size: 0.85rem;
    }
    .user-name-nav {
      font-weight: 500;
      font-size: 0.9rem;
    }

    .mobile-menu-btn {
      display: none;
      background: none;
      border: none;
      font-size: 1.5rem;
      color: #1E293B;
      cursor: pointer;
    }

    /* ========== MAIN LAYOUT ========== */
    .dashboard-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 2rem 2rem;
    }

    /* Welcome / Profile Header */
    .welcome-section {
      background: white;
      border-radius: 24px;
      padding: 1.8rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 1.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 4px 16px rgba(0,0,0,0.03);
      border: 1px solid #f1f5f9;
    }

    .profile-info {
      display: flex;
      align-items: center;
      gap: 1.2rem;
    }

    .profile-avatar-lg {
      width: 64px;
      height: 64px;
      background: #4338CA;
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 1.5rem;
      box-shadow: 0 10px 20px rgba(67,56,202,0.25);
    }

    .profile-details h3 {
      font-size: 1.3rem;
      font-weight: 700;
    }
    .profile-details .dept {
      color: #6366F1;
      font-weight: 500;
      font-size: 0.85rem;
      background: #EEF2FF;
      padding: 0.2rem 0.8rem;
      border-radius: 20px;
      display: inline-block;
      margin-top: 0.3rem;
    }
    .profile-details .emp-id {
      font-size: 0.8rem;
      color: #64748b;
      margin-top: 0.2rem;
    }

    .quick-stats {
      display: flex;
      gap: 2rem;
    }
    .quick-stat {
      text-align: center;
    }
    .quick-stat .value {
      font-weight: 700;
      font-size: 1.6rem;
      color: #0F172A;
    }
    .quick-stat .label {
      font-size: 0.75rem;
      color: #64748b;
    }

    /* Cards Grid */
    .cards-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .card {
      background: white;
      border-radius: 20px;
      padding: 1.5rem;
      box-shadow: 0 4px 16px rgba(0,0,0,0.03);
      border: 1px solid #f1f5f9;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(0,0,0,0.06);
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.2rem;
    }
    .card-header h4 {
      font-weight: 600;
      font-size: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .card-header .icon-circle {
      width: 32px;
      height: 32px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
    }
    .icon-assigned { background: #FEF3C7; color: #F59E0B; }
    .icon-returned { background: #DCFCE7; color: #10B981; }
    .icon-history { background: #EEF2FF; color: #4338CA; }
    .icon-fine { background: #FEE2E2; color: #EF4444; }

    .badge-sm {
      font-size: 0.7rem;
      padding: 0.2rem 0.7rem;
      border-radius: 30px;
      font-weight: 600;
    }
    .badge-assigned { background: #FEF3C7; color: #B45309; }
    .badge-returned { background: #DCFCE7; color: #166534; }
    .badge-pending { background: #FEE2E2; color: #991B1B; }
    .badge-paid { background: #DCFCE7; color: #166534; }
    .badge-unpaid { background: #FEE2E2; color: #991B1B; }

    /* Asset list */
    .asset-list {
      list-style: none;
    }
    .asset-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.8rem 0;
      border-bottom: 1px solid #f1f5f9;
    }
    .asset-item:last-child {
      border-bottom: none;
    }
    .asset-name {
      font-weight: 500;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .asset-date {
      font-size: 0.75rem;
      color: #64748b;
    }

    /* Request history */
    .history-item {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      padding: 0.7rem 0;
      border-bottom: 1px solid #f1f5f9;
    }
    .history-item:last-child { border-bottom: none; }
    .history-icon {
      width: 34px;
      height: 34px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.8rem;
    }
    .history-details {
      flex: 1;
    }
    .history-details .title {
      font-weight: 500;
      font-size: 0.85rem;
    }
    .history-details .date {
      font-size: 0.7rem;
      color: #64748b;
    }

    /* Fine section */
    .fine-amount {
      font-size: 2rem;
      font-weight: 700;
      color: #EF4444;
    }
    .fine-detail {
      display: flex;
      justify-content: space-between;
      padding: 0.5rem 0;
      font-size: 0.85rem;
      border-bottom: 1px solid #f1f5f9;
    }
    .btn-pay {
      background: #4338CA;
      color: white;
      border: none;
      padding: 0.6rem 1.5rem;
      border-radius: 30px;
      font-weight: 600;
      cursor: pointer;
      margin-top: 1rem;
      width: 100%;
      transition: 0.2s;
    }
    .btn-pay:hover {
      background: #6366F1;
    }

    /* Full width card for history */
    .full-width {
      grid-column: 1 / -1;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .nav-links {
        display: none;
      }
      .mobile-menu-btn {
        display: block;
      }
      .nav-links.mobile-open {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 70px;
        left: 0;
        width: 100%;
        background: white;
        padding: 1.5rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        gap: 1rem;
      }
      .dashboard-container {
        padding: 1.2rem;
      }
      .welcome-section {
        flex-direction: column;
        align-items: flex-start;
      }
      .quick-stats {
        width: 100%;
        justify-content: space-around;
      }
      .cards-grid {
        grid-template-columns: 1fr;
      }
    }

    /* animations */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-card {
      animation: fadeUp 0.5s ease forwards;
      opacity: 0;
    }
  </style>
</head>
<body>
  <!-- ========== NAVBAR ========== -->
  <nav class="navbar">
    <div class="nav-brand">
      <div class="brand-icon">📦</div>
      <div class="brand-text">Solutions<span>Tech</span></div>
    </div>

    <button class="mobile-menu-btn" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>

    <ul class="nav-links" id="navLinks">
      <li><a href="#" class="active"><i class="fas fa-th-large"></i> Dashboard</a></li>
      <li><a href="#"><i class="fas fa-laptop"></i> My Assets</a></li>
      <li><a href="#"><i class="fas fa-history"></i> Requests</a></li>
      <li><a href="#"><i class="fas fa-exclamation-triangle"></i> Fines</a></li>
    </ul>

    <div class="nav-actions">
      <div class="notification-bell">
        <i class="far fa-bell"></i>
        <span class="dot"></span>
      </div>
      <div class="user-profile-nav">
        <div class="user-avatar-nav">AK</div>
        <span class="user-name-nav">Ahmed Khan</span>
        <i class="fas fa-chevron-down" style="font-size:0.7rem; color:#94a3b8;"></i>
      </div>
    </div>
  </nav>

  <!-- ========== DASHBOARD CONTENT ========== -->
  <div class="dashboard-container">
    
    <!-- Welcome / Profile Section -->
    <div class="welcome-section animate-card" style="animation-delay: 0.1s;">
      <div class="profile-info">
        <div class="profile-avatar-lg">AK</div>
        <div class="profile-details">
          <h3>Ahmed Khan</h3>
          <span class="dept">Information Technology</span>
          <div class="emp-id">EMP-2024-0892</div>
        </div>
      </div>
      <div class="quick-stats">
        <div class="quick-stat">
          <div class="value">3</div>
          <div class="label">Assets Assigned</div>
        </div>
        <div class="quick-stat">
          <div class="value">2</div>
          <div class="label">Returned</div>
        </div>
        <div class="quick-stat">
          <div class="value">₹500</div>
          <div class="label">Pending Fine</div>
        </div>
      </div>
    </div>

    <!-- Cards Grid -->
    <div class="cards-grid">
      
      <!-- Assigned Assets Card -->
      <div class="card animate-card" style="animation-delay: 0.2s;">
        <div class="card-header">
          <h4><span class="icon-circle icon-assigned"><i class="fas fa-box"></i></span> Assigned Assets</h4>
          <span class="badge-sm badge-assigned">3 Active</span>
        </div>
        <ul class="asset-list">
          <li class="asset-item">
            <div>
              <div class="asset-name"><i class="fas fa-laptop" style="color:#6366F1;"></i> Dell Latitude 5540</div>
              <div class="asset-date">Assigned: 12 Jan 2026</div>
            </div>
            <span class="badge-sm badge-assigned">In Use</span>
          </li>
          <li class="asset-item">
            <div>
              <div class="asset-name"><i class="fas fa-mouse" style="color:#6366F1;"></i> Logitech MX Master</div>
              <div class="asset-date">Assigned: 12 Jan 2026</div>
            </div>
            <span class="badge-sm badge-assigned">In Use</span>
          </li>
          <li class="asset-item">
            <div>
              <div class="asset-name"><i class="fas fa-headphones" style="color:#6366F1;"></i> Sony WH-1000XM5</div>
              <div class="asset-date">Assigned: 05 Feb 2026</div>
            </div>
            <span class="badge-sm badge-assigned">In Use</span>
          </li>
        </ul>
      </div>

      <!-- Returned Assets Card -->
      <div class="card animate-card" style="animation-delay: 0.3s;">
        <div class="card-header">
          <h4><span class="icon-circle icon-returned"><i class="fas fa-undo-alt"></i></span> Returned Assets</h4>
          <span class="badge-sm badge-returned">2 Returned</span>
        </div>
        <ul class="asset-list">
          <li class="asset-item">
            <div>
              <div class="asset-name"><i class="fas fa-keyboard" style="color:#10B981;"></i> Mechanical Keyboard</div>
              <div class="asset-date">Returned: 20 Mar 2026</div>
            </div>
            <span class="badge-sm badge-returned">Returned</span>
          </li>
          <li class="asset-item">
            <div>
              <div class="asset-name"><i class="fas fa-monitor" style="color:#10B981;"></i> Samsung 24" Monitor</div>
              <div class="asset-date">Returned: 15 Feb 2026</div>
            </div>
            <span class="badge-sm badge-returned">Returned</span>
          </li>
        </ul>
      </div>

      <!-- Request History Card -->
      <div class="card animate-card" style="animation-delay: 0.4s;">
        <div class="card-header">
          <h4><span class="icon-circle icon-history"><i class="fas fa-history"></i></span> Request History</h4>
          <span class="badge-sm" style="background:#EEF2FF; color:#4338CA;">4 Requests</span>
        </div>
        <div>
          <div class="history-item">
            <div class="history-icon" style="background:#DCFCE7; color:#10B981;"><i class="fas fa-check"></i></div>
            <div class="history-details">
              <div class="title">Headphones Request</div>
              <div class="date">Approved · 05 Feb 2026</div>
            </div>
            <span class="badge-sm badge-returned">Approved</span>
          </div>
          <div class="history-item">
            <div class="history-icon" style="background:#FEF3C7; color:#F59E0B;"><i class="fas fa-clock"></i></div>
            <div class="history-details">
              <div class="title">Monitor Replacement</div>
              <div class="date">Pending · 28 Jun 2026</div>
            </div>
            <span class="badge-sm badge-assigned">Pending</span>
          </div>
          <div class="history-item">
            <div class="history-icon" style="background:#DCFCE7; color:#10B981;"><i class="fas fa-check"></i></div>
            <div class="history-details">
              <div class="title">Laptop Upgrade</div>
              <div class="date">Approved · 10 Jan 2026</div>
            </div>
            <span class="badge-sm badge-returned">Approved</span>
          </div>
          <div class="history-item">
            <div class="history-icon" style="background:#FEE2E2; color:#EF4444;"><i class="fas fa-times"></i></div>
            <div class="history-details">
              <div class="title">Tablet Request</div>
              <div class="date">Rejected · 01 Dec 2025</div>
            </div>
            <span class="badge-sm badge-pending">Rejected</span>
          </div>
        </div>
      </div>

      <!-- Fines Card -->
      <div class="card animate-card" style="animation-delay: 0.5s;">
        <div class="card-header">
          <h4><span class="icon-circle icon-fine"><i class="fas fa-exclamation-triangle"></i></span> Fines & Penalties</h4>
          <span class="badge-sm badge-unpaid">1 Unpaid</span>
        </div>
        <div style="text-align:center; margin-bottom:1rem;">
          <div class="fine-amount">₹500</div>
          <div style="color:#64748b; font-size:0.8rem;">Total Outstanding</div>
        </div>
        <div class="fine-detail">
          <span>Late Return - Keyboard</span>
          <span style="font-weight:600; color:#EF4444;">₹500</span>
        </div>
        <div class="fine-detail">
          <span>Damaged Mouse (Paid)</span>
          <span style="font-weight:600; color:#10B981;">₹200 ✓</span>
        </div>
        <button class="btn-pay"><i class="fas fa-credit-card"></i> Pay Now</button>
      </div>

    </div>

    <!-- Department Info & Full Width Card -->
    <div class="card animate-card full-width" style="animation-delay: 0.6s; margin-top:0.5rem;">
      <div class="card-header">
        <h4><span class="icon-circle" style="background:#EEF2FF; color:#4338CA;"><i class="fas fa-building"></i></span> Department Information</h4>
      </div>
      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); gap:1.5rem;">
        <div>
          <div style="font-size:0.75rem; color:#64748b; text-transform:uppercase; letter-spacing:0.5px;">Department</div>
          <div style="font-weight:600; margin-top:0.3rem;">Information Technology</div>
        </div>
        <div>
          <div style="font-size:0.75rem; color:#64748b; text-transform:uppercase; letter-spacing:0.5px;">Manager</div>
          <div style="font-weight:600; margin-top:0.3rem;">Sara Ahmed</div>
        </div>
        <div>
          <div style="font-size:0.75rem; color:#64748b; text-transform:uppercase; letter-spacing:0.5px;">Location</div>
          <div style="font-weight:600; margin-top:0.3rem;">Floor 3, Block A</div>
        </div>
        <div>
          <div style="font-size:0.75rem; color:#64748b; text-transform:uppercase; letter-spacing:0.5px;">Total Team Members</div>
          <div style="font-weight:600; margin-top:0.3rem;">12 Members</div>
        </div>
      </div>
    </div>

  </div>

  <script>
    (function() {
      // Mobile menu toggle
      const mobileMenuBtn = document.getElementById('mobileMenuBtn');
      const navLinks = document.getElementById('navLinks');
      
      if (mobileMenuBtn && navLinks) {
        mobileMenuBtn.addEventListener('click', () => {
          navLinks.classList.toggle('mobile-open');
        });
        
        // Close menu when link clicked
        navLinks.querySelectorAll('a').forEach(link => {
          link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
              navLinks.classList.remove('mobile-open');
            }
          });
        });
      }

      // Notification bell animation
      const bell = document.querySelector('.notification-bell');
      if (bell) {
        bell.addEventListener('click', () => {
          alert('🔔 You have 2 new notifications:\n- Asset return reminder\n- Fine payment due');
        });
      }

      // Pay Now button
      const payBtn = document.querySelector('.btn-pay');
      if (payBtn) {
        payBtn.addEventListener('click', () => {
          alert('💳 Redirecting to payment gateway...\n(CodeIgniter integration)');
        });
      }

      // User profile dropdown
      const userProfileNav = document.querySelector('.user-profile-nav');
      if (userProfileNav) {
        userProfileNav.addEventListener('click', () => {
          alert('👤 Profile Options:\n- View Profile\n- Settings\n- Logout');
        });
      }

      // Animate cards on scroll (simple visibility)
      const animateCards = document.querySelectorAll('.animate-card');
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }
        });
      }, { threshold: 0.1 });

      animateCards.forEach(card => {
        observer.observe(card);
      });

      console.log('👤 User Dashboard ready — Employee Asset Management');
    })();
  </script>
</body>
</html>