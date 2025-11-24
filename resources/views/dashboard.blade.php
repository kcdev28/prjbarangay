<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

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
                    <a href="{{ route('admin.dashboard') }}" class="active">
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
                <div class="stats-grid">
                    <div class="stat-card primary">
                        <div class="stat-number">2,450</div>
                        <div class="stat-label">Total Residents</div>
                    </div>

                    <div class="stat-card success">
                        <div class="stat-number">2,180</div>
                        <div class="stat-label">Verified Residents</div>
                    </div>

                    <div class="stat-card info">
                        <div class="stat-number">1,240</div>
                        <div class="stat-label">Male</div>
                    </div>

                    <div class="stat-card pink">
                        <div class="stat-number">1,210</div>
                        <div class="stat-label">Female</div>
                    </div>

                    <div class="stat-card warning">
                        <div class="stat-number">1,890</div>
                        <div class="stat-label">Voters</div>
                    </div>

                    <div class="stat-card secondary">
                        <div class="stat-number">560</div>
                        <div class="stat-label">Non-Voters</div>
                    </div>

                    <div class="stat-card purple">
                        <div class="stat-number">85</div>
                        <div class="stat-label">LGBTQ Members</div>
                    </div>

                    <div class="stat-card danger">
                        <div class="stat-number">12</div>
                        <div class="stat-label">Disputes</div>
                    </div>

                    <div class="stat-card primary">
                        <div class="stat-number">520</div>
                        <div class="stat-label">Households</div>
                    </div>

                    <div class="stat-card success">
                        <div class="stat-number">1,680</div>
                        <div class="stat-label">Employed</div>
                    </div>

                    <div class="stat-card danger">
                        <div class="stat-number">340</div>
                        <div class="stat-label">Unemployed</div>
                    </div>

                    <div class="stat-card warning">
                        <div class="stat-number">62</div>
                        <div class="stat-label">PWD</div>
                    </div>

                    <div class="stat-card info">
                        <div class="stat-number">445</div>
                        <div class="stat-label">Minors</div>
                    </div>

                    <div class="stat-card warning">
                        <div class="stat-number">156</div>
                        <div class="stat-label">Senior Citizens</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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

        updateDateTime();
        setInterval(updateDateTime, 1000);

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

        function confirmLogout(event) {
            event.preventDefault();

            if (confirm('Are you sure you want to logout?')) {
                document.getElementById('logoutForm').submit();
            }
        }
    </script>
</body>

</html>