    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Resident Records - Barangay Admin Dashboard</title>
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/residents.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <a href="{{ route('admin.residents') }}" class="active">
                            <img src="{{ asset('icons/crowd-of-users.png') }}" alt="Resident Record">
                            <span>Resident Record</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.officials') }}">
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
                    <div class="page-header">
                        <h1 class="page-title">Resident Records</h1>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#residentModal" onclick="openAddModal()">
                            <i class="bi bi-plus-circle"></i> Add Resident
                        </button>
                    </div>

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
                                    <option value="Not Verified">Not Verified</option>
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
                                    <option value="Registered Voter">Registered Voter</option>
                                    <option value="Non-Registered">Non-Registered</option>
                                    <option value="First Time Voter">First Time Voter</option>
                                    <option value="Inactive Voter">Inactive Voter</option>
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

        <!-- Resident Modal -->
        <div class="modal fade" id="residentModal" tabindex="-1" aria-labelledby="residentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="residentModalLabel">Add Resident</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="residentForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="residentId" name="id">
                        <input type="hidden" id="formMethod" name="_method" value="POST">

                        <div class="modal-body">
                            <!-- Personal Information -->
                            <h6 class="section-title">Personal Information</h6>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="profile_img" class="form-label">Profile Image</label>
                                    <input type="file" class="form-control" id="profile_img" name="profile_img" accept="image/*">
                                    <div id="profilePreview" class="mt-2"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="middle_name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name">
                                </div>
                                <div class="col-md-4">
                                    <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="suffix" class="form-label">Suffix</label>
                                    <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Jr., Sr., III">
                                </div>
                            </div>

                            <!-- Other Details -->
                            <h6 class="section-title mt-4">Other Details</h6>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="civil_status" class="form-label">Civil Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="civil_status" name="civil_status" required>
                                        <option value="">Select Status</option>
                                        @foreach($civilStatuses as $status)
                                        <option value="{{ $status->civilID }}">{{ $status->civil_stat }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="religion" class="form-label">Religion <span class="text-danger">*</span></label>
                                    <select class="form-select" id="religion" name="religion" required>
                                        <option value="">Select Religion</option>
                                        @foreach($religions as $religion)
                                        <option value="{{ $religion->religionID }}">{{ $religion->religion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="voter_status" class="form-label">Voter Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="voter_status" name="voter_status" required>
                                        <option value="">Select Status</option>
                                        <option value="Registered Voter">Registered Voter</option>
                                        <option value="Non-Registered">Non-Registered</option>
                                        <option value="First Time Voter">First Time Voter</option>
                                        <option value="Inactive Voter">Inactive Voter</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="contact_no" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="09XXXXXXXXX">
                                </div>
                                <div class="col-md-4">
                                    <label for="precinct_no" class="form-label">Precinct No.</label>
                                    <input type="text" class="form-control" id="precinct_no" name="precinct_no">
                                </div>
                                <div class="col-md-4">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input type="text" class="form-control" id="occupation" name="occupation">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="employment_status" class="form-label">Employment Status</label>
                                    <select class="form-select" id="employment_status" name="employment_status">
                                        <option value="">Select Status</option>
                                        <option value="Employed">Employed</option>
                                        <option value="Unemployed">Unemployed</option>
                                        <option value="Self-Employed">Self-Employed</option>
                                        <option value="Student">Student</option>
                                        <option value="Retired">Retired</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="special_group" class="form-label">Special Group</label>
                                    <select class="form-select" id="special_group" name="special_group">
                                        <option value="">Select Group</option>
                                        @foreach($specialStatuses as $group)
                                        <option value="{{ $group->specialID }}">{{ $group->status }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="verify_img" class="form-label">Verification Document (ID)</label>
                                    <input type="file" class="form-control" id="verify_img" name="verify_img" accept="image/*">
                                    <div id="verifyPreview" class="mt-2"></div>
                                </div>
                            </div>

                            <!-- Address Information -->
                            <h6 class="section-title mt-4">Address Information</h6>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="house_no" class="form-label">House No.</label>
                                    <input type="text" class="form-control" id="house_no" name="house_no">
                                </div>
                                <div class="col-md-4">
                                    <label for="street" class="form-label">Street <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="street" name="street" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="area" class="form-label">Area <span class="text-danger">*</span></label>
                                    <select class="form-select" id="area" name="area" required>
                                        <option value="">Select Area</option>
                                        @foreach($areas as $area)
                                        <option value="{{ $area->areaID}}">{{ $area->area_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="barangay" class="form-label">Barangay <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="barangay" name="barangay" value="San Agustin" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                            </div>


                            <h6 class="section-title mt-4">Account Information</h6>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveBtn">Save Resident</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <!-- View Modal -->
        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">Resident Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="viewModalBody">
                        <!-- Content will be populated by JavaScript -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let residents = [];

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

            function fetchResidents() {
                fetch('/api/residents')
                    .then(response => response.json())
                    .then(data => {
                        residents = data;
                        renderTable();
                    })
                    .catch(error => {
                        console.error('Error fetching residents:', error);
                    });
            }

            function renderTable() {
                const tableBody = document.getElementById('tableBody');
                const noResults = document.getElementById('noResults');
                const recordCount = document.getElementById('recordCount');

                tableBody.innerHTML = '';

                const filteredResidents = applyFilters();

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
                    const fullName = `${resident.firstname} ${resident.middlename || ''} ${resident.lastname} ${resident.suffix || ''}`.trim();
                    const age = calculateAge(resident.date_of_birth);

                    row.innerHTML = `
                        <td>${resident.residentID}</td>
                        <td>${fullName}</td>
                        <td>${age}</td>
                        <td><span class="gender-badge ${genderClass}">${resident.gender}</span></td>
                        <td>${resident.contact_no || 'N/A'}</td>
                        <td><span class="status-badge ${statusClass}">${resident.status || 'Pending'}</span></td>
                        <td>${resident.voter_status}</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-small btn-view" onclick="viewResident(${resident.residentID})">View</button>
                                <button class="btn-small btn-edit" onclick="editResident(${resident.residentID})">Edit</button>
                                <button class="btn-small btn-delete" onclick="deleteResident(${resident.residentID})">Delete</button>
                            </div>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            }

            function calculateAge(dateOfBirth) {
                const today = new Date();
                const birthDate = new Date(dateOfBirth);
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            }

            function applyFilters() {
                const searchValue = document.getElementById('searchInput').value.toLowerCase();
                const statusValue = document.getElementById('statusFilter').value;
                const genderValue = document.getElementById('genderFilter').value;
                const voterValue = document.getElementById('voterFilter').value;

                return residents.filter(resident => {
                    const fullName = `${resident.firstname} ${resident.middlename || ''} ${resident.lastname}`.toLowerCase();
                    const matchSearch = fullName.includes(searchValue) || resident.residentID.toString().includes(searchValue);
                    const matchStatus = statusValue === '' || resident.status === statusValue;
                    const matchGender = genderValue === '' || resident.gender === genderValue;
                    const matchVoter = voterValue === '' || resident.voter_status === voterValue;

                    return matchSearch && matchStatus && matchGender && matchVoter;
                });
            }

            function resetFilters() {
                document.getElementById('searchInput').value = '';
                document.getElementById('statusFilter').value = '';
                document.getElementById('genderFilter').value = '';
                document.getElementById('voterFilter').value = '';
                renderTable();
            }

            let currentResidentId = null;

            function openAddModal() {
                document.getElementById('residentModalLabel').textContent = 'Add Resident';
                document.getElementById('residentForm').reset();
                currentResidentId = null; // no ID for new resident
                document.getElementById('formMethod').value = 'POST';
                document.getElementById('profilePreview').innerHTML = '';
                document.getElementById('verifyPreview').innerHTML = '';
            }

            function viewResident(id) {
                const resident = residents.find(r => r.residentID === id);
                if (!resident) return;

                const fullName = `${resident.firstname} ${resident.middlename || ''} ${resident.lastname} ${resident.suffix || ''}`.trim();
                const age = calculateAge(resident.date_of_birth);

                // Use the full URL if available, otherwise construct it
                const profileImageSrc = resident.profile_image_url || (resident.profile_image ? `/storage/${resident.profile_image}` : null);
                const verifyImageSrc = resident.verify_image_url || (resident.verify_image ? `/storage/${resident.verify_image}` : null);

                const content = `
        <div class="row">
            <div class="col-md-12 text-center mb-3">
                ${profileImageSrc 
                    ? `<img src="${profileImageSrc}" alt="Profile" class="img-thumbnail" style="max-width: 200px;">` 
                    : '<p>No profile image uploaded</p>'}
            </div>
            <div class="col-md-6">
                <p><strong>Full Name:</strong> ${fullName}</p>
                <p><strong>Date of Birth:</strong> ${resident.date_of_birth}</p>
                <p><strong>Age:</strong> ${age}</p>
                <p><strong>Gender:</strong> ${resident.gender}</p>
                <p><strong>Civil Status:</strong> ${resident.civil_status}</p>
                <p><strong>Religion:</strong> ${resident.religion}</p>
                <p><strong>Contact:</strong> ${resident.contact_no || 'N/A'}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Voter Status:</strong> ${resident.voter_status}</p>
                <p><strong>Precinct No:</strong> ${resident.precinct_no || 'N/A'}</p>
                <p><strong>Occupation:</strong> ${resident.occupation || 'N/A'}</p>
                <p><strong>Employment Status:</strong> ${resident.employment_status || 'N/A'}</p>
                <p><strong>Special Group:</strong> ${resident.special_group || 'None'}</p>
             
            </div>
            <div class="col-md-12 mt-3">
                <h6>Address</h6>
                <p>${resident.house_no ? resident.house_no + ' ' : ''}${resident.street},${resident.area}, ${resident.barangay}, ${resident.city}</p>
            </div>
            ${verifyImageSrc ? `
            <div class="col-md-12 mt-3 text-center">
                <h6>Verification Document</h6>
                <img src="${verifyImageSrc}" alt="Verification" class="img-thumbnail" style="max-width: 800px; max-height: 700px; width: auto; height: auto;">
            </div>` : '<div class="col-md-12 mt-3"><p>No verification document uploaded</p></div>'}
        </div>
    `;

                document.getElementById('viewModalBody').innerHTML = content;
                new bootstrap.Modal(document.getElementById('viewModal')).show();
            }

            function editResident(id) {
                const resident = residents.find(r => r.residentID === id);
                if (!resident) return;

                currentResidentId = resident.residentID; // store ID for editing

                document.getElementById('residentModalLabel').textContent = 'Edit Resident';
                document.getElementById('residentId').value = resident.residentID || '';
                document.getElementById('formMethod').value = 'PUT';
                document.getElementById('first_name').value = resident.firstname || '';
                document.getElementById('middle_name').value = resident.middlename || '';
                document.getElementById('last_name').value = resident.lastname || '';
                document.getElementById('suffix').value = resident.suffix || '';
                document.getElementById('date_of_birth').value = resident.date_of_birth;
                document.getElementById('gender').value = resident.gender || '';
                document.getElementById('civil_status').value = resident.civil_status || '';
                document.getElementById('voter_status').value = resident.voter_status || '';
                document.getElementById('religion').value = resident.religion || '';
                document.getElementById('special_group').value = resident.special_group || '';
                document.getElementById('precinct_no').value = resident.precinct_no || '';
                document.getElementById('contact_no').value = resident.contact_no || '';
                document.getElementById('occupation').value = resident.occupation || '';
                document.getElementById('employment_status').value = resident.employment_status || '';
                document.getElementById('house_no').value = resident.house_no || '';
                document.getElementById('street').value = resident.street || '';
                document.getElementById('area').value = resident.area || '';
                document.getElementById('barangay').value = resident.barangay || '';
                document.getElementById('city').value = resident.city || '';
                document.getElementById('username').value = resident.username;


                if (resident.profile_image) {
                    document.getElementById('profilePreview').innerHTML = `<img src="/storage/${resident.profile_image}" alt="Profile" class="img-thumbnail" style="max-width: 150px;">`;
                }
                if (resident.verify_image) {
                    document.getElementById('verifyPreview').innerHTML = `<img src="/storage/${resident.verify_image}" alt="Verification" class="img-thumbnail" style="max-width: 150px;">`;
                }

                new bootstrap.Modal(document.getElementById('residentModal')).show();
            }

            function deleteResident(id) {
                if (confirm('Are you sure you want to delete this resident record?')) {
                    fetch(`/api/residents/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Resident deleted successfully!');
                                fetchResidents();
                            }
                        })
                        .catch(error => {
                            console.error('Error deleting resident:', error);
                            alert('Error deleting resident');
                        });
                }
            }

            document.getElementById('residentForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                // For editing, use POST with _method override
                if (currentResidentId) {
                    formData.append('_method', 'PUT');
                }

                const url = currentResidentId ? `/api/residents/${currentResidentId}` : '/api/residents';
                const method1 = 'POST'; // Always use POST

                fetch(url, {
                        method: method1,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    })
                    .then(async response => {
                        if (!response.ok) {
                            const text = await response.text();
                            throw new Error(`HTTP ${response.status}: ${text}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert('Resident saved successfully!');
                            fetchResidents();
                            bootstrap.Modal.getInstance(document.getElementById('residentModal')).hide();
                        } else {
                            alert('Error saving resident.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error saving resident. Check console for details.');
                    });
            });


            // Preview images
            document.getElementById('profile_img').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('profilePreview').innerHTML = `<img src="${e.target.result}" alt="Profile Preview" class="img-thumbnail" style="max-width: 150px;">`;
                    };
                    reader.readAsDataURL(file);
                }
            });

            document.getElementById('verify_img').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('verifyPreview').innerHTML = `<img src="${e.target.result}" alt="Verification Preview" class="img-thumbnail" style="max-width: 150px;">`;
                    };
                    reader.readAsDataURL(file);
                }
            });

            function confirmLogout(event) {
                event.preventDefault();
                if (confirm('Are you sure you want to logout?')) {
                    document.getElementById('logoutForm').submit();
                }
            }

            document.getElementById('searchInput').addEventListener('input', renderTable);
            document.getElementById('statusFilter').addEventListener('change', renderTable);
            document.getElementById('genderFilter').addEventListener('change', renderTable);
            document.getElementById('voterFilter').addEventListener('change', renderTable);

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
            fetchResidents();
        </script>
    </body>

    </html>