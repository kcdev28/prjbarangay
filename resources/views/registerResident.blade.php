<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>San Agustin E-Services - Registration</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/registerResident.css') }}">
</head>

<body>

    <nav class="navbar navbar-custom">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="#">
                <img src="images/sanagustinlogo.png" style="width: 50px;" alt="">
                San Agustin E-Services
            </a>
            <div class="d-flex gap-3 align-items-center">
            </div>
        </div>
    </nav>


    <div class="registration-container">
        <div class="registration-card">
            <h1 class="registration-title">Register Account</h1>

            <ul class="nav nav-tabs" id="registrationTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal"
                        type="button" role="tab" aria-controls="personal" aria-selected="true">Personal
                        Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address"
                        type="button" role="tab" aria-controls="address" aria-selected="false">Address
                        Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="account-tab" data-bs-toggle="tab" data-bs-target="#account"
                        type="button" role="tab" aria-controls="account" aria-selected="false">Account
                        Information</button>
                </li>
            </ul>

            <form id="registrationForm" method="POST" action="{{ route('resident.store') }}" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="tab-content" id="registrationTabContent">

                    <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First Name *</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="middleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middleName" name="middleName">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="suffix" class="form-label">Suffix</label>
                                        <select class="form-select" id="suffix" name="suffix">
                                            <option value="">Select Suffix</option>
                                            <option value="Jr">Jr.</option>
                                            <option value="Sr">Sr.</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="dateOfBirth" class="form-label">Date of Birth *</label>
                                        <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="gender" class="form-label">Gender *</label>
                                        <select class="form-select" id="gender" name="gender" required>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="LGBTQ">LGBTQ</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="civilStatus" class="form-label">Civil Status</label>
                                        <select class="form-select" id="civilStatus" name="civilStatus">
                                            <option value="">Select Civil Status</option>
                                            @foreach($civilStatuses as $status)
                                            <option value="{{ $status->civilID }}">{{ $status->civil_stat }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="contactNo" class="form-label">Contact No. *</label>
                                        <input type="tel" class="form-control" id="contactNo" name="contactNo" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="religion" class="form-label">Religion</label>
                                        <select class="form-select" id="religion" name="religion">
                                            <option value="">Select Religion</option>
                                            @foreach($religions as $religion)
                                            <option value="{{ $religion->religionID }}">{{ $religion->religion }}</option>
                                            @endforeach
                                        </select>


                                    </div>
                                    <div class="col-md-6">
                                        <label for="voterStatus" class="form-label">Voter Status</label>
                                        <select class="form-select" id="voterStatus" name="voterStatus">
                                            <option value="">Select Voter Status</option>
                                            <option value="Registered Voter">Registered Voter</option>
                                            <option value="Non-Registered">Non-Registered</option>
                                            <option value="First Time Voter">First Time Voter</option>
                                            <option value="Inactive Voter">Inactive Voter</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="precintNo" class="form-label">Precinct No.</label>
                                        <input type="text" class="form-control" id="precintNo" name="precintNo">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="occupation" class="form-label">Occupation</label>
                                        <input type="text" class="form-control" id="occupation" name="occupation">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="employmentStatus" class="form-label">Employment Status</label>
                                        <select class="form-select" id="employmentStatus" name="employmentStatus">
                                            <option value="">Select Employment Status</option>
                                            <option value="Employed">Employed</option>
                                            <option value="Self-Employed">Self-Employed</option>
                                            <option value="Unemployed">Unemployed</option>
                                            <option value="Student">Student</option>
                                            <option value="Retired">Retired</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="specialGroupStatus" class="form-label">Special Group Status</label>
                                        <select class="form-select" id="specialGroupStatus" name="specialGroupStatus">
                                            <option value="">Select Special Group Status</option>
                                            @foreach($specialStatuses as $group)
                                            <option value="{{ $group->specialID }}">{{ $group->status }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="citizenship" class="form-label">Citizenship </label>
                                    <select class="form-select" id="citizenshipTop" name="citizenship">
                                        <option value="">Select Citizenship</option>
                                        <option value="Filipino">Filipino</option>
                                        <option value="Foreign">Foreign</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Profile Picture (Optional)</label>
                                    <div style="display: flex; gap: 10px; align-items: flex-start;">
                                        <div>
                                            <div class="profile-picture-container">
                                                <video id="cameraStream" autoplay playsinline></video>
                                            </div>
                                            <button type="button" class="btn-primary-custom mt-3"
                                                onclick="capturePhoto()">Capture Photo</button>
                                        </div>
                                        <div>
                                            <div class="profile-picture-container">
                                                <img id="capturedImage" style="display:none;">
                                            </div>
                                        </div>
                                    </div>
                                    <canvas id="capturedCanvas" style="display:none;"></canvas>
                                    <input type="hidden" id="profilePictureData" name="profilePictureData">
                                </div>

                                <div class="mb-3">
                                    <label for="verificationId" class="form-label">For verification upload photo of any Valid ID, Meralco Bill, Internet Bill</label>
                                    <div class="verification-id-container mb-3">
                                        <div id="idPreview" class="id-preview"></div>
                                    </div>
                                    <input type="file" class="form-control" id="verificationId" name="verificationId" accept="image/*">
                                    <small class="text-muted">Accepted formats: JPG, PNG</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                        <div class="mb-3">
                            <label for="houseNumber" class="form-label">House Number *</label>
                            <input type="text" class="form-control" id="houseNumber" name="houseNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="street" class="form-label">Street *</label>
                            <input type="text" class="form-control" id="street" name="street" required>
                        </div>

                        <div class="mb-3">
                            <label for="area" class="form-label">Area *</label>
                            <select class="form-select" id="area" name="area" required>
                                <option value="">Select Area</option>
                                @foreach($areas as $area)
                                <option value="{{ $area->areaID }}">{{ $area->area_name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="barangay" class="form-label">Barangay *</label>
                            <input type="text" class="form-control" id="barangay" name="barangay" value="San Agustin" required>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">City *</label>
                            <input type="text" class="form-control" id="city" name="city" value="Quezon City" required>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <div class="mb-3">
                            <label for="email" class="form-label">Username *</label>
                            <input type="username" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="mb-3 password-toggle">
                            <label for="password" class="form-label">Password *</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <button type="button" class="password-toggle-btn" data-target="password">Show</button>
                        </div>

                        <div class="mb-3 password-toggle">
                            <label for="confirmPassword" class="form-label">Confirm Password *</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                            <button type="button" class="password-toggle-btn" data-target="confirmPassword">Show</button>
                            <div id="passwordMismatchMessage" class="text-danger mt-1" style="display: none; font-size: 0.875rem;">
                                Passwords do not match
                            </div>
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="button" class="btn-secondary-custom" id="prevBtn"
                        style="display: none;">Previous</button>
                    <button type="button" class="btn-primary-custom" id="nextBtn">Next</button>
                    <button type="submit" class="btn-primary-custom" id="submitBtn"
                        style="display: none;">Register</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const closeMenuBtn = document.getElementById('closeMenuBtn');
        const sideMenu = document.getElementById('sideMenu');
        const menuOverlay = document.getElementById('menuOverlay');
        const menuLinks = document.querySelectorAll('.menu-list li a');

        if (closeMenuBtn) {
            closeMenuBtn.addEventListener('click', () => {
                sideMenu.classList.remove('active');
                menuOverlay.classList.remove('active');
            });
        }

        if (menuOverlay) {
            menuOverlay.addEventListener('click', () => {
                sideMenu.classList.remove('active');
                menuOverlay.classList.remove('active');
            });
        }

        menuLinks.forEach(link => {
            link.addEventListener('click', () => {
                sideMenu.classList.remove('active');
                menuOverlay.classList.remove('active');
            });
        });

        const tabs = document.querySelectorAll('.nav-link');
        const tabContents = document.querySelectorAll('.tab-pane');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        const submitBtn = document.getElementById('submitBtn');
        let currentTab = 0;

        function updateTabStates() {
            tabs.forEach((tab, index) => {
                if (index <= currentTab) {

                    tab.classList.remove('disabled');
                } else {

                    tab.classList.add('disabled');
                }
            });
        }

        function showTab(n) {
            tabs.forEach(tab => tab.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('show', 'active'));

            tabs[n].classList.add('active');
            tabContents[n].classList.add('show', 'active');

            prevBtn.style.display = n === 0 ? 'none' : 'block';
            nextBtn.style.display = n === tabContents.length - 1 ? 'none' : 'block';
            submitBtn.style.display = n === tabContents.length - 1 ? 'block' : 'none';

            currentTab = n;
            updateTabStates();
        }

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();

                if (index <= currentTab) {
                    showTab(index);
                }
            });
        });


        function validateCurrentTab() {
            const currentTabPane = tabContents[currentTab];
            const inputs = currentTabPane.querySelectorAll('input[required], select[required]');
            let isValid = true;
            let firstInvalidField = null;

            inputs.forEach(input => {

                input.classList.remove('is-invalid');


                if (input.hasAttribute('required') && !input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = input;
                    }
                }
            });

            if (!isValid && firstInvalidField) {
                firstInvalidField.focus();
            }

            return isValid;
        }



        nextBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (validateCurrentTab() && currentTab < tabContents.length - 1) {
                showTab(currentTab + 1);
            }
        });

        prevBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (currentTab > 0) {
                showTab(currentTab - 1);
            }
        });


    
        document.getElementById('registrationForm').addEventListener('submit', async function(e) {
            e.preventDefault();

        
            let allValid = true;
            for (let i = 0; i < tabContents.length; i++) {
                currentTab = i;
                if (!validateCurrentTab()) {
                    allValid = false;
                    showTab(i);
                    break;
                }
            }

            if (!allValid) {
                return;
            }

      
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirmPassword');
            const mismatchMessage = document.getElementById('passwordMismatchMessage');

            if (passwordField.value !== confirmPasswordField.value) {
                mismatchMessage.style.display = 'block';
                confirmPasswordField.classList.add('is-invalid');
                showTab(2);
                return;
            }

            const formData = new FormData(this);

            submitBtn.disabled = true;
            submitBtn.textContent = 'Registering...';

            try {
                const response = await fetch("{{ route('resident.store') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    if (result.errors) {
                        let firstErrorTab = null;
                        let errorMessages = [];

                        for (let field in result.errors) {
                            const element = document.getElementById(field);

                            errorMessages.push(...result.errors[field]);

                            if (element) {
                                element.classList.add('is-invalid');

                                if (!firstErrorTab) {
                                    const tabPane = element.closest('.tab-pane');
                                    if (tabPane) {
                                        const tabIndex = Array.from(tabContents).indexOf(tabPane);
                                        firstErrorTab = tabIndex;
                                    }
                                }
                            }

                        
                            if (field === 'username') {
                                showTab(2); 
                                alert('Username already taken. Please choose a different username.');
                                return;
                            }
                        }

                        if (firstErrorTab !== null) {
                            showTab(firstErrorTab);
                        }

                       
                        if (errorMessages.length > 0) {
                            alert('Please correct the following errors:\n\n' + errorMessages.join('\n'));
                        }
                    } else {
                        alert(result.message || 'Registration failed. Please try again.');
                    }
                    return;
                }

                alert(result.message);

                this.reset();

                const capturedImage = document.getElementById('capturedImage');
                const profilePictureData = document.getElementById('profilePictureData');
                if (capturedImage) {
                    capturedImage.style.display = 'none';
                    capturedImage.src = '';
                }
                if (profilePictureData) {
                    profilePictureData.value = '';
                }

                document.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });

                showTab(0);

                setTimeout(() => {
                    window.location.href = "{{ route('login') }}";
                }, 1500);

            } catch (error) {
                console.error('Registration error:', error);
                alert('An error occurred during registration. Please try again.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Register';
            }
        });

        showTab(0);
        updateTabStates();



        const video = document.getElementById("cameraStream");
        const canvas = document.getElementById("capturedCanvas");
        const img = document.getElementById("capturedImage");
        const hiddenInput = document.getElementById("profilePictureData");

        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.log("Camera access denied or not available - this is normal for some environments");
            });

        function capturePhoto() {
            const context = canvas.getContext("2d");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL("image/png");
            img.src = imageData;
            img.style.display = "block";
            hiddenInput.value = imageData;
        }

        const today = new Date().toISOString().split('T')[0];
        document.getElementById('dateOfBirth').setAttribute('max', today);


        document.querySelectorAll('.password-toggle-btn').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const field = document.getElementById(targetId);

                if (field.type === 'password') {
                    field.type = 'text';
                    this.textContent = 'Hide';
                } else {
                    field.type = 'password';
                    this.textContent = 'Show';
                }
            });
        });
    </script>

</body>

</html>