<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Records - Barangay Admin Dashboard</title>
   <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
     <link rel="stylesheet" href="{{ asset('css/residents.css') }}">
   
</head>
<body>
    <div class="wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <img src="images/sanagustinlogo.png" alt="Logo">
                </div>
                <div class="brand-name">San Agustin</div>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="dashboard.html">
                        <img src="icons/data-report.png" alt="Dashboard">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="residents.html" class="active">
                        <img src="icons/crowd-of-users.png" alt="Resident Record">
                        <span>Resident Record</span>
                    </a>
                </li>
                <li>
                    <a href="officials.html">
                        <img src="icons/group.png" alt="Barangay Officials & Staff">
                        <span>Barangay Officials & Staff</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="icons/house.png" alt="Household">
                        <span>Household</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="icons/resolution.png" alt="Blotter Records">
                        <span>Blotter Records</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle">
                        <img src="icons/quality.png" alt="Certificates">
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
                        <img src="icons/custom-clearance.png" alt="Clearance">
                        <span>Clearance</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="icons/advertising.png" alt="Announcement">
                        <span>Announcement</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="icons/audit.png" alt="Audit Trail">
                        <span>Audit Trail</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="icons/web-settings.png" alt="Maintenance">
                        <span>Maintenance</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="icons/self-employed.png" alt="User Accounts">
                        <span>User Accounts</span>
                    </a>
                </li>
            </ul>

            <div class="logout-section">
                <button class="logout-btn">
                    <img src="icons/logout.png" alt="Logout">
                    <span>Logout</span>
                </button>
            </div>
        </aside>

        <div class="main-content">
            <header class="header">
                <div>
                    <div class="user-name" id="userName">Juan Dela Cruz</div>
                    <div class="date-time" id="dateTime"></div>
                </div>
            </header>

            <div class="content">
                <h1 class="page-title">Resident Records</h1>

                <div class="filter-section">
                    <div class="filter-group">
                        <div class="filter-item">
                            <label for="searchInput">Search by Name or ID</label>
                            <input type="text" id="searchInput" placeholder="Enter name or ID...">
                        </div>
                        <div class="filter-item">
                            <label for="statusFilter">Status</label>
                            <select id="statusFilter">
                                <option value="">All Status</option>
                                <option value="Verified">Not Verified</option>
                                <option value="Verified">Verified</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                        <div class="filter-item">
                            <label for="genderFilter">Gender</label>
                            <select id="genderFilter">
                                <option value="">All Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="filter-item">
                            <label for="voterFilter">Voter Status</label>
                            <select id="voterFilter">
                                <option value="">All</option>
                                <option value="Voter">Voter</option>
                                <option value="Non-Voter">Non-Voter</option>
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
                        <table id="residentTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Voter</th>
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
        const mockResidents = [
            { id: 'RES001', name: 'Maria Santos', age: 32, gender: 'Female', contact: '09171234567', status: 'Verified', voter: 'Voter' },
            { id: 'RES002', name: 'Juan Dela Cruz', age: 45, gender: 'Male', contact: '09171234568', status: 'Verified', voter: 'Voter' },
            { id: 'RES003', name: 'Rosa Garcia', age: 28, gender: 'Female', contact: '09171234569', status: 'Pending', voter: 'Non-Voter' },
            { id: 'RES004', name: 'Carlos Reyes', age: 55, gender: 'Male', contact: '09171234570', status: 'Verified', voter: 'Voter' },
            { id: 'RES005', name: 'Ana Lopez', age: 38, gender: 'Female', contact: '09171234571', status: 'Verified', voter: 'Voter' },
            { id: 'RES006', name: 'Miguel Torres', age: 42, gender: 'Male', contact: '09171234572', status: 'Verified', voter: 'Voter' },
            { id: 'RES007', name: 'Jennifer Aquino', age: 26, gender: 'Female', contact: '09171234573', status: 'Pending', voter: 'Non-Voter' },
            { id: 'RES008', name: 'Robert Fernandez', age: 50, gender: 'Male', contact: '09171234574', status: 'Verified', voter: 'Voter' },
            { id: 'RES009', name: 'Patricia Morales', age: 35, gender: 'Female', contact: '09171234575', status: 'Verified', voter: 'Non-Voter' },
            { id: 'RES010', name: 'Antonio Cruz', age: 60, gender: 'Male', contact: '09171234576', status: 'Verified', voter: 'Voter' },
        ];

        let filteredResidents = [...mockResidents];

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

            if (filteredResidents.length === 0) {
                tableBody.style.display = 'none';
                noResults.style.display = 'block';
                recordCount.textContent = 0;
                return;
            }

            tableBody.style.display = 'table-row-group';
            noResults.style.display = 'none';
            recordCount.textContent = filteredResidents.length;

            filteredResidents.forEach(resident => {
                const row = document.createElement('tr');
                const statusClass = resident.status === 'Verified' ? 'status-verified' : 'status-pending';
                const genderClass = resident.gender === 'Male' ? 'gender-male' : 'gender-female';
                
                row.innerHTML = `
                    <td>${resident.id}</td>
                    <td>${resident.name}</td>
                    <td>${resident.age}</td>
                    <td><span class="gender-badge ${genderClass}">${resident.gender}</span></td>
                    <td>${resident.contact}</td>
                    <td><span class="status-badge ${statusClass}">${resident.status}</span></td>
                    <td>${resident.voter}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-small btn-view">View</button>
                            <button class="btn-small btn-edit">Edit</button>
                            <button class="btn-small btn-delete" onclick="deleteResident('${resident.id}')">Delete</button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        function applyFilters() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const statusValue = document.getElementById('statusFilter').value;
            const genderValue = document.getElementById('genderFilter').value;
            const voterValue = document.getElementById('voterFilter').value;

            filteredResidents = mockResidents.filter(resident => {
                const matchSearch = resident.name.toLowerCase().includes(searchValue) || resident.id.toLowerCase().includes(searchValue);
                const matchStatus = statusValue === '' || resident.status === statusValue;
                const matchGender = genderValue === '' || resident.gender === genderValue;
                const matchVoter = voterValue === '' || resident.voter === voterValue;

                return matchSearch && matchStatus && matchGender && matchVoter;
            });

            renderTable();
        }

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('genderFilter').value = '';
            document.getElementById('voterFilter').value = '';
            filteredResidents = [...mockResidents];
            renderTable();
        }

        function deleteResident(residentId) {
            if (confirm('Are you sure you want to delete this resident record?')) {
                mockResidents = mockResidents.filter(resident => resident.id !== residentId);
                applyFilters();
            }
        }

        document.getElementById('searchInput').addEventListener('input', applyFilters);
        document.getElementById('statusFilter').addEventListener('change', applyFilters);
        document.getElementById('genderFilter').addEventListener('change', applyFilters);
        document.getElementById('voterFilter').addEventListener('change', applyFilters);

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