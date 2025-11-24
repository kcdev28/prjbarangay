<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Officials & Staff - Barangay Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/officials.css') }}">
</head>
<body>
    <div class="wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <img src="{{ asset('images/sanagustinlogo.png') }}" alt="Logo">
                </div>
                <div class="brand-name">Brgy. San Agustin</div>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('icons/data-report.png') }}" alt="Dashboard">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.residents') }}">
                        <img src="{{ asset('icons/crowd-of-users.png') }}" alt="Resident Record">
                        <span>Resident Record</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.officials') }}" class="active">
                        <img src="{{ asset('icons/group.png') }}" alt="Barangay Officials & Staff">
                        <span>Barangay Officials & Staff</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('icons/house.png') }}" alt="Household">
                        <span>Household</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('icons/resolution.png') }}" alt="Blotter Records">
                        <span>Blotter Records</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle">
                        <img src="{{ asset('icons/quality.png') }}" alt="Certificates">
                        <span>Certificates</span>
                    </a>
                    <ul class="submenu" id="certificatesMenu">
                        <li>
                            <a href="#">
                                <span>Certificate of Indigency</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Certificate of Residency</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span>First Time Job Seeker</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('icons/custom-clearance.png') }}" alt="Clearance">
                        <span>Clearance</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('icons/advertising.png') }}" alt="Announcement">
                        <span>Announcement</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('icons/audit.png') }}" alt="Audit Trail">
                        <span>Audit Trail</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('icons/web-settings.png') }}" alt="Maintenance">
                        <span>Maintenance</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('icons/self-employed.png') }}" alt="User Accounts">
                        <span>User Accounts</span>
                    </a>
                </li>
            </ul>

            <div class="logout-section">
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button class="logout-btn" onclick="confirmLogout(event)">
                    <img src="{{ asset('icons/logout.png') }}" alt="Logout">
                    <span>Logout</span>
                </button>
            </div>
        </aside>

        <div class="main-content">
            <header class="header">
                <div>
                    <div class="user-name" id="userName">{{ session('user_name') }}</div>
                    <div class="date-time" id="dateTime"></div>
                </div>
            </header>

            <div class="content">
                <h1 class="page-title">Barangay Officials & Staff</h1>

                <div class="filter-section">
                    <div class="filter-group">
                        <div class="filter-item">
                            <label for="searchInput">Search by Name or Position</label>
                            <input type="text" id="searchInput" placeholder="Enter name or position...">
                        </div>
                        <div class="filter-item">
                            <label for="positionFilter">Position</label>
                            <select id="positionFilter">
                                <option value="">All Positions</option>
                                <option value="Barangay Captain">Barangay Captain</option>
                                <option value="Barangay Kagawad">Barangay Kagawad</option>
                                <option value="Barangay Secretary">Barangay Secretary</option>
                                <option value="Barangay Treasurer">Barangay Treasurer</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                        <div class="filter-item">
                            <label for="statusFilter">Status</label>
                            <select id="statusFilter">
                                <option value="">All Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <button class="btn-reset" onclick="resetFilters()">Reset Filters</button>
                    </div>
                </div>

                <div class="table-section">
                    <div class="table-header">
                        <span class="record-count">Showing <span id="recordCount">0</span> records</span>
                    </div>
                    <div class="table-responsive">
                        <table id="officialsTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Term Start</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                            </tbody>
                        </table>
                        <div id="noResults" class="no-results" style="display:none;">
                            No records found.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const mockOfficials = [
            { id: 'OFF001', name: 'Jose Reyes', position: 'Barangay Captain', contact: '09171234567', email: 'jose.reyes@barangay.com', status: 'Active', termStart: '2022-06-30' },
            { id: 'OFF002', name: 'Maria Santos', position: 'Barangay Kagawad', contact: '09171234568', email: 'maria.santos@barangay.com', status: 'Active', termStart: '2022-06-30' },
            { id: 'OFF003', name: 'Carlos Fernandez', position: 'Barangay Kagawad', contact: '09171234569', email: 'carlos.fernandez@barangay.com', status: 'Active', termStart: '2022-06-30' },
            { id: 'OFF004', name: 'Ana Lopez', position: 'Barangay Secretary', contact: '09171234570', email: 'ana.lopez@barangay.com', status: 'Active', termStart: '2022-06-30' },
            { id: 'OFF005', name: 'Miguel Torres', position: 'Barangay Treasurer', contact: '09171234571', email: 'miguel.torres@barangay.com', status: 'Active', termStart: '2022-06-30' },
            { id: 'OFF006', name: 'Rosa Garcia', position: 'Barangay Kagawad', contact: '09171234572', email: 'rosa.garcia@barangay.com', status: 'Active', termStart: '2022-06-30' },
            { id: 'OFF007', name: 'Juan Aquino', position: 'Staff', contact: '09171234573', email: 'juan.aquino@barangay.com', status: 'Inactive', termStart: '2021-06-30' },
            { id: 'OFF008', name: 'Patricia Morales', position: 'Staff', contact: '09171234574', email: 'patricia.morales@barangay.com', status: 'Active', termStart: '2023-01-15' },
            { id: 'OFF009', name: 'Roberto Cruz', position: 'Barangay Kagawad', contact: '09171234575', email: 'roberto.cruz@barangay.com', status: 'Active', termStart: '2022-06-30' },
            { id: 'OFF010', name: 'Jennifer Ramos', position: 'Staff', contact: '09171234576', email: 'jennifer.ramos@barangay.com', status: 'Active', termStart: '2023-03-20' },
        ];

        let filteredOfficials = [...mockOfficials];

        function updateDateTime() {
            const dateTimeElement = document.getElementById('dateTime');
            const now = new Date();
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            const formattedDateTime = now.toLocaleDateString('en-US', options);
            dateTimeElement.textContent = formattedDateTime;
        }

        function renderTable() {
            const tableBody = document.getElementById('tableBody');
            const noResults = document.getElementById('noResults');
            const recordCount = document.getElementById('recordCount');

            tableBody.innerHTML = '';

            if (filteredOfficials.length === 0) {
                tableBody.style.display = 'none';
                noResults.style.display = 'block';
                recordCount.textContent = 0;
                return;
            }

            tableBody.style.display = 'table-row-group';
            noResults.style.display = 'none';
            recordCount.textContent = filteredOfficials.length;

            filteredOfficials.forEach(official => {
                const row = document.createElement('tr');
                const statusClass = official.status === 'Active' ? 'status-active' : 'status-inactive';
                const date = new Date(official.termStart).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
                
                row.innerHTML = `
                    <td>${official.id}</td>
                    <td>${official.name}</td>
                    <td>${official.position}</td>
                    <td>${official.contact}</td>
                    <td>${official.email}</td>
                    <td><span class="status-badge ${statusClass}">${official.status}</span></td>
                    <td>${date}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-small btn-view">View</button>
                            <button class="btn-small btn-edit">Edit</button>
                            <button class="btn-small btn-delete" onclick="deleteOfficial('${official.id}')">Delete</button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        function applyFilters() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const positionValue = document.getElementById('positionFilter').value;
            const statusValue = document.getElementById('statusFilter').value;

            filteredOfficials = mockOfficials.filter(official => {
                const matchSearch = official.name.toLowerCase().includes(searchValue) || official.position.toLowerCase().includes(searchValue);
                const matchPosition = positionValue === '' || official.position === positionValue;
                const matchStatus = statusValue === '' || official.status === statusValue;

                return matchSearch && matchPosition && matchStatus;
            });

            renderTable();
        }

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('positionFilter').value = '';
            document.getElementById('statusFilter').value = '';
            filteredOfficials = [...mockOfficials];
            renderTable();
        }

        function deleteOfficial(officialId) {
            if (confirm('Are you sure you want to delete this official record?')) {
                const index = mockOfficials.findIndex(official => official.id === officialId);
                if (index > -1) {
                    mockOfficials.splice(index, 1);
                }
                applyFilters();
            }
        }

        function confirmLogout(event) {
            event.preventDefault();

            if (confirm('Are you sure you want to logout?')) {
                document.getElementById('logoutForm').submit();
            }
        }

        document.getElementById('searchInput').addEventListener('input', applyFilters);
        document.getElementById('positionFilter').addEventListener('change', applyFilters);
        document.getElementById('statusFilter').addEventListener('change', applyFilters);

        const dropdownToggle = document.querySelector('.dropdown-toggle');
        const certificatesMenu = document.getElementById('certificatesMenu');

        dropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            certificatesMenu.classList.toggle('show');
        });

        const menuItems = document.querySelectorAll('.sidebar-menu > li > a:not(.dropdown-toggle)');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                menuItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        updateDateTime();
        setInterval(updateDateTime, 1000);
        renderTable();
    </script>
</body>
</html>