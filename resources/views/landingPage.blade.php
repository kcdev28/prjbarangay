<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>San Agustin E-Services</title>
     <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
     <link rel="stylesheet" href="{{ asset('css/landingPage.css') }}">

</head>

<body>

    <nav class="navbar navbar-custom">
        <div class="container-fluid px-4">

            <a class="navbar-brand" href="#">
                <img src="images/sanagustinlogo.png" style="width: 50px;" alt="">
                San Agustin E-Services
            </a>
            <div class="d-flex gap-3 align-items-center">
                <button class="btn-menu" id="menuBtn">
                    <img src="images/menu.png" style="width: 10px;" alt="">Menu
                </button>
                <div class="user-dropdown">
                    <div class="dropdown">
                        <button class="user-profile-btn" data-bs-toggle="dropdown">
                            <span class="user-name">Karen Gonzales</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">View Profile</a></li>
                            <li><a class="dropdown-item" href="#">My Request</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div id="sideMenu" class="side-menu">
        <button class="close-menu" id="closeMenuBtn">
            &times;
        </button>
        <ul class="menu-list">
            <li><a href="#">Home</a></li>
            <li><a href="#">Barangay ID Application</a></li>
            <li><a href="#">Barangay Clearance</a></li>
            <li><a href="#">Certificates Request</a></li>
            <li><a href="#">Business Permit</a></li>
            <li><a href="#">Blotter Report</a></li>
            <li><a href="#">Household Info</a></li>
            <li><a href="#">Officials</a></li>
            <li><a href="#">Mission & Vision</a></li>
            <li><a href="#">Announcements</a></li>
        </ul>
    </div>
    <div id="menuOverlay" class="menu-overlay"></div>


    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/home.JPG" class="d-block w-100" alt="...">
                <div class="carousel-overlay">
                    <div class="carousel-text">
                        <h1>Welcome to Barangay San Agustin</h1>
                        <p>E-Services System</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/home1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-overlay">
                    <div class="carousel-text">
                        <h1>Serving Our Community</h1>
                        <p>Online Services Made Easy</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/home2.JPG" class="d-block w-100" alt="...">
                <div class="carousel-overlay">
                    <div class="carousel-text">
                        <h1>Your Trusted Partner</h1>
                        <p>Quality Services for All</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section id="services" class="services-section">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <img src="images/card.png" style="width: 120px;" alt="">
                        <h5 class="service-title">Barangay ID Application</h5>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <img src="images/file.png" style="width: 120px;" alt="">
                        <h5 class="service-title mt-2">Barangay Clearance Request</h5>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <img src="images/policy.png" style="width: 120px;" alt="">
                        <h5 class="service-title">Barangay Certificates</h5>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <img src="images/approval.png" style="width: 120px;" alt="">
                        <h5 class="service-title">Business Permit</h5>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <img src="images/report.png" style="width: 120px;" alt="">
                        <h5 class="service-title">Blotter Report</h5>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <img src="images/family.png" style="width: 120px;" alt="">
                        <h5 class="service-title">Household Information</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer>
        <div class="footer-content">
            <div class="footer-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3180.4155609706354!2d121.0375284268437!3d14.729362641123487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0542d0ccaf1%3A0x54be2536d53a48e8!2sSan%20Agustin%20Barangay%20Hall!5e1!3m2!1sen!2sph!4v1763160848325!5m2!1sen!2sph"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="footer-contact">
                <h3>Contact Us</h3>
                <div class="contact-item">
                    <img src="images/whitepin.png" style="width: 20px;" alt="">
                    <span>Barangay San Agustin, Metro Manila, Philippines</span>
                </div>
                <div class="contact-item">
                    <img src="images/whitephone.png" style="width: 20px;" alt="">
                    <a href="tel:+639123456789">(+63) 912-345-6789</a>
                </div>
                <div class="contact-item">
                    <img src="images/whiteemail.png" style="width: 20px;" alt="">
                    <a href="mailto:info@sanagustin.gov.ph">info@sanagustin.gov.ph</a>
                </div>
                <div class="contact-item">
                    <img src="images/time.png" style="width: 20px;" alt="">
                    <span>Mon - Fri: 8:00 AM - 5:00 PM</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Barangay San Agustin E-Services. All rights reserved.</p>
        </div>
    </footer>


    <script>
        const menuBtn = document.getElementById('menuBtn');
        const closeMenuBtn = document.getElementById('closeMenuBtn');
        const sideMenu = document.getElementById('sideMenu');
        const menuOverlay = document.getElementById('menuOverlay');
        const menuLinks = document.querySelectorAll('.menu-list li a');


        menuBtn.addEventListener('click', () => {
            sideMenu.classList.add('active');
            menuOverlay.classList.add('active');
        });


        closeMenuBtn.addEventListener('click', () => {
            sideMenu.classList.remove('active');
            menuOverlay.classList.remove('active');
        });


        menuOverlay.addEventListener('click', () => {
            sideMenu.classList.remove('active');
            menuOverlay.classList.remove('active');
        });


        menuLinks.forEach(link => {
            link.addEventListener('click', () => {
                sideMenu.classList.remove('active');
                menuOverlay.classList.remove('active');
            });
        });


        const serviceCards = document.querySelectorAll('.service-card');
        serviceCards.forEach(card => {
            card.addEventListener('click', function () {
                const serviceName = this.querySelector('.service-title').textContent;
                console.log('Clicked service:', serviceName);

            });
        });
    </script>
</body>

</html>