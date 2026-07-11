  (function() {
      // Sample employee data (simulating database)
      const employees = [
        { name: "Ahmed Ali", role: "Software Engineer", dept: "IT", assetsAssigned: "Laptop, Mouse", assetReturn: "Keyboard", status: "assigned" },
        { name: "Sara Khan", role: "HR Manager", dept: "Human Resources", assetsAssigned: "Laptop", assetReturn: "None", status: "returned" },
        { name: "Bilal Hussain", role: "Accountant", dept: "Finance", assetsAssigned: "Monitor, Headset", assetReturn: "Laptop", status: "assigned" },
        { name: "Ayesha Malik", role: "Graphic Designer", dept: "Creative", assetsAssigned: "iMac, Tablet", assetReturn: "None", status: "pending" },
        { name: "Omar Farooq", role: "Project Manager", dept: "Operations", assetsAssigned: "Laptop, Phone", assetReturn: "Headset", status: "assigned" },
        { name: "Zara Sheikh", role: "Data Analyst", dept: "IT", assetsAssigned: "Laptop", assetReturn: "Laptop", status: "returned" },
        { name: "Tariq Mehmood", role: "Support Lead", dept: "Customer Support", assetsAssigned: "Desktop, Headset", assetReturn: "None", status: "assigned" },
        { name: "Hina Riaz", role: "Marketing Specialist", dept: "Marketing", assetsAssigned: "Laptop", assetReturn: "Mouse", status: "assigned" }
      ];

      const tableBody = document.querySelector("#employeeTable tbody");
      const searchInput = document.getElementById("searchInput");
      const menuToggle = document.getElementById("menuToggle");
      const sidebar = document.getElementById("sidebar");
      const totalEmployeesEl = document.getElementById("totalEmployees");
      const totalAssignedEl = document.getElementById("totalAssigned");
      const totalReturnedEl = document.getElementById("totalReturned");

      // Function to render table based on data
      function renderTable(data) {
        if (!tableBody) return;
        tableBody.innerHTML = "";
        
        if (data.length === 0) {
          tableBody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:2rem; color:#64748b;">No employees found.</td></tr>`;
          updateStats(data);
          return;
        }

        data.forEach((emp, index) => {
          const initials = emp.name.split(" ").map(n => n[0]).join("").toUpperCase();
          const statusClass = emp.status === 'assigned' ? 'badge-assigned' : (emp.status === 'returned' ? 'badge-returned' : 'badge-pending');
          const statusText = emp.status.charAt(0).toUpperCase() + emp.status.slice(1);
          
          const row = document.createElement("tr");
          row.style.animation = `fadeUp 0.3s ease forwards`;
          row.style.animationDelay = `${index * 0.04}s`;
          row.style.opacity = "0";
          setTimeout(() => { row.style.opacity = "1"; }, 20);

          row.innerHTML = `
            <td>
              <div class="employee-cell">
                <div class="emp-avatar">${initials}</div>
                <span style="font-weight:500;">${emp.name}</span>
              </div>
            </td>
            <td><span class="role-badge">${emp.role}</span></td>
            <td><span class="department">${emp.dept}</span></td>
            <td>${emp.assetsAssigned}</td>
            <td>${emp.assetReturn}</td>
            <td><span class="badge ${statusClass}">${statusText}</span></td>
            <td class="action-icons">
              <i class="fas fa-eye" title="View"></i>
              <i class="fas fa-edit" title="Edit"></i>
              <i class="fas fa-trash-alt" title="Delete"></i>
            </td>
          `;
          tableBody.appendChild(row);
        });

        updateStats(data);
      }

      // Update statistics cards
      function updateStats(data) {
        const total = data.length;
        const assignedCount = data.filter(e => e.status === 'assigned').length;
        const returnedCount = data.filter(e => e.status === 'returned').length;
        
        if (totalEmployeesEl) totalEmployeesEl.textContent = total;
        if (totalAssignedEl) totalAssignedEl.textContent = assignedCount;
        if (totalReturnedEl) totalReturnedEl.textContent = returnedCount;
      }

      // Filter by search
      function filterEmployees(searchTerm) {
        const term = searchTerm.toLowerCase().trim();
        if (term === "") {
          renderTable(employees);
          return;
        }
        const filtered = employees.filter(emp => 
          emp.name.toLowerCase().includes(term) || 
          emp.role.toLowerCase().includes(term) ||
          emp.dept.toLowerCase().includes(term) ||
          emp.assetsAssigned.toLowerCase().includes(term)
        );
        renderTable(filtered);
      }

      // Event listeners
      if (searchInput) {
        searchInput.addEventListener("input", (e) => filterEmployees(e.target.value));
      }

      // Mobile sidebar toggle
      if (menuToggle && sidebar) {
        menuToggle.addEventListener("click", () => {
          sidebar.classList.toggle("open");
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener("click", (e) => {
          if (window.innerWidth <= 900) {
            if (!sidebar.contains(e.target) && e.target !== menuToggle && !menuToggle.contains(e.target)) {
              sidebar.classList.remove("open");
            }
          }
        });
      }

      // Simulate action clicks (for demo)
      document.addEventListener("click", (e) => {
        if (e.target.classList.contains("fa-trash-alt")) {
          alert("🗑️ Delete employee (demo)");
        } else if (e.target.classList.contains("fa-edit")) {
          alert("✏️ Edit employee details");
        } else if (e.target.classList.contains("fa-eye")) {
          alert("👁️ View employee profile");
        }
      });

      // Initial render
      renderTable(employees);

      // Add entrance animation for stats cards
      const statCards = document.querySelectorAll(".stat-card");
      statCards.forEach((card, i) => {
        card.style.opacity = "0";
        card.style.transform = "translateY(15px)";
        card.style.transition = "0.4s ease";
        setTimeout(() => {
          card.style.opacity = "1";
          card.style.transform = "translateY(0)";
        }, 150 + i * 100);
      });

      console.log("📊 Admin Dashboard ready — Employee Asset Management");
    })();