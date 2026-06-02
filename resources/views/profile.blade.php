<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Jewelry Order System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <style>
        body { 
            background-color: #f8fafc; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0f172a;
            overflow-x: hidden;
        }
        
        /* Persistent Desktop Sidebar Configuration */
        .sidebar { 
            width: 260px; 
            background: #ffffff; 
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #e2e8f0;
        }

        .sidebar .nav-link { 
            color: #64748b; 
            padding: 12px 20px; 
            margin: 4px 16px; 
            border-radius: 10px; 
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link:hover { 
            background-color: #f1f5f9; 
            color: #0f172a; 
        }

        .sidebar .nav-link.active {
            font-weight: 600;
            background-color: #4f46e5;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        }

        /* Fluid Layout Content Viewports */
        .main-content { 
            margin-left: 260px;
            padding: 40px; 
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Modern Typography and Components */
        .card { 
            background: #ffffff;
            border: 1px solid #e2e8f0; 
            border-radius: 16px; 
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .form-label { 
            font-weight: 600; 
            color: #334155; 
            font-size: 0.8rem; 
            text-transform: uppercase; 
            letter-spacing: 0.5px; 
        }

        .form-control, .form-select, .input-group-text { 
            border-radius: 10px; 
            padding: 10px 16px; 
            border: 1px solid #cbd5e1; 
            color: #0f172a;
            font-size: 0.95rem;
            transition: all 0.2s ease; 
        }

        .input-group-text {
            background-color: #f8fafc;
            color: #64748b;
            border-right: none;
        }

        .input-group > .form-control, .input-group > .form-select {
            border-left: none;
        }

        .form-control:focus, .form-select:focus { 
            border-color: #4f46e5; 
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); 
            color: #0f172a;
        }

        /* Profile Custom Dynamic Image Elements */
        .profile-picture-container { 
            position: relative; 
            display: inline-block; 
        }
        
        .profile-picture-preview { 
            width: 130px; 
            height: 130px; 
            border-radius: 50%; 
            object-fit: cover; 
            border: 4px solid #ffffff; 
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.08); 
            transition: transform 0.2s ease;
        }

        .profile-picture-container:hover .profile-picture-preview {
            transform: scale(1.02);
        }
        
        .upload-btn-wrapper { 
            position: relative; 
            overflow: hidden; 
            display: inline-block; 
        }
        
        .upload-btn-wrapper input[type=file] { 
            position: absolute; 
            left: 0; 
            top: 0; 
            opacity: 0; 
            cursor: pointer; 
            width: 100%; 
            height: 100%; 
        }

        /* Responsive Adaptations */
        @media (max-width: 991.98px) {
            .sidebar {
                display: none !important;
            }
            .main-content {
                margin-left: 0;
                padding: 24px 16px;
            }
        }
    </style>
</head>
<body>

<!-- DESKTOP FIXED NAVIGATION SIDEBAR -->
<div class="sidebar d-none d-lg-flex flex-column justify-content-between">
    <div>
        <div class="p-4 border-bottom border-light">
            <h5 class="mb-0 fw-bold text-dark d-flex align-items-center"><i class="fas fa-gem me-2 text-indigo" style="color: #4f46e5;"></i>Jewelry Shop</h5>
            <small class="text-muted text-uppercase tracking-wider mt-1 d-block" style="font-size: 0.65rem; letter-spacing: 1px;">Management System</small>
        </div>
        
        <nav class="nav flex-column mt-4">
            <a class="nav-link" href="/dashboard"><i class="fas fa-fw fa-chart-pie me-2"></i> Dashboard</a>
            <a class="nav-link" href="/orders"><i class="fas fa-fw fa-shopping-cart me-2"></i> Orders</a>
            <a class="nav-link" href="/orders/create"><i class="fas fa-fw fa-plus-circle me-2"></i> Add Order</a>
            <a class="nav-link active" href="/profile"><i class="fas fa-fw fa-user me-2"></i> My Profile</a>
        </nav>
    </div>

    <div class="p-3 border-top border-light">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-start text-decoration-none w-100 py-2.5 px-3 text-muted nav-link m-0 d-flex align-items-center">
                <i class="fas fa-sign-out-alt me-2"></i> Sign Out
            </button>
        </form>
    </div>
</div>

<!-- CONTAINER MOBILE ACTIONS ACCESSIBILITY BAR -->
<nav class="navbar navbar-light bg-white border-bottom d-lg-none px-3 sticky-top w-100 shadow-sm">
    <span class="navbar-brand fw-bold text-dark"><i class="fas fa-gem me-2 text-indigo" style="color: #4f46e5;"></i>Jewelry Shop</span>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<!-- OFF-CANVAS SIDEBAR DRAWER FOR RESPONSIVE PHONES -->
<div class="offcanvas offcanvas-start bg-white text-dark d-lg-none" tabindex="-1" id="mobileSidebar" style="width: 280px;">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold text-dark"><i class="fas fa-gem me-2 text-indigo" style="color: #4f46e5;"></i>Jewelry Shop</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0 d-flex flex-column justify-content-between">
        <nav class="nav flex-column mt-3">
            <a class="nav-link py-3 px-4 text-muted" href="/dashboard"><i class="fas fa-fw fa-chart-pie me-3"></i> Dashboard</a>
            <a class="nav-link py-3 px-4 text-muted" href="/orders"><i class="fas fa-fw fa-shopping-cart me-3"></i> Orders</a>
            <a class="nav-link py-3 px-4 text-muted" href="/orders/create"><i class="fas fa-fw fa-plus-circle me-3"></i> Add Order</a>
            <a class="nav-link active py-3 px-4" href="/profile"><i class="fas fa-fw fa-user me-3"></i> My Profile</a>
        </nav>
        <div class="p-3 border-top">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link text-start text-decoration-none w-100 py-3 px-4 text-muted m-0">
                    <i class="fas fa-sign-out-alt me-3"></i> Sign Out
                </button>
            </form>
        </div>
    </div>
</div>

<!-- MAIN VIEW CONTENT CONTENT BLOCK -->
<div class="main-content">
    
    <!-- Title Area Area -->
    <div class="mb-5">
        <h2 class="fw-bold tracking-tight mb-1" style="color: #0f172a;">My Profile</h2>
        <p class="text-muted mb-0">Manage account information, contact credentials, and avatar parameters.</p>
    </div>

    <div class="row g-4">
        <!-- Avatar Modification Card Left Column -->
        <div class="col-12 col-lg-4 mb-2">
            <div class="card p-3 shadow-sm border-0 text-center h-100">
                <div class="card-body py-5 d-flex flex-column align-items-center justify-content-center">
                    <div class="profile-picture-container mb-4">
                        <img src="{{ asset('storage/uploads/' . ($user->profile_picture ?? 'default-avatar.png')) }}" 
                             alt="Profile Picture" 
                             class="profile-picture-preview"
                             id="profilePicturePreview">
                    </div>
                    
                    <h4 class="fw-bold text-dark mb-1">{{ $user->username }}</h4>
                    <p class="text-muted small mb-4 d-flex align-items-center justify-content-center">
                        <i class="fas fa-envelope me-2 text-secondary opacity-75"></i>{{ $user->email }}
                    </p>
                    
                    <div class="upload-btn-wrapper">
                        <button class="btn btn-sm btn-outline-primary px-4 py-2 rounded-3 fw-medium" style="color: #4f46e5; border-color: #cbd5e1;">
                            <i class="fas fa-camera me-2"></i>Change Profile Picture
                        </button>
                        <input type="file" id="profilePictureInput" accept="image/*" onchange="previewImage(this)">
                    </div>
                </div>
            </div>
        </div>

        <!-- Master Fields Input Form Grid Right Column -->
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-4 px-4 border-bottom-0">
                    <h5 class="m-0 fw-bold text-dark d-flex align-items-center">
                        <i class="fas fa-user-cog me-2 text-muted" style="font-size: 1.1rem;"></i>Account Information
                    </h5>
                </div>
                <div class="card-body p-4 pt-0">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
                        @csrf
                        @method('PUT')
                        <input type="file" name="profile_picture" id="hiddenFileInput" style="display: none;">
                        
                        <div class="row g-4 mb-4">
                            <div class="col-12 col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user small"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->username) }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope small"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-4 mb-4">
                            <div class="col-12 col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone small"></i></span>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter contact number">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-venus-mars small"></i></span>
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt small"></i></span>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}">
                            </div>
                        </div>
                        
                        <div class="mb-5">
                            <label for="address" class="form-label">Complete Address</label>
                            <div class="input-group">
                                <span class="input-group-text align-items-start pt-2.5"><i class="fas fa-map-marked-alt small"></i></span>
                                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter residential address" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">{{ old('address', $user->address) }}</textarea>
                            </div>
                        </div>
                        
                        <div class="pt-4 border-top d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary px-4 py-2.5 rounded-3 fw-medium shadow-sm" style="background-color: #4f46e5; border-color: #4f46e5;">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                            <a href="/dashboard" class="btn btn-light px-4 py-2.5 rounded-3 border text-secondary fw-medium">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = { "closeButton": true, "progressBar": true, "positionClass": "toast-top-right", "timeOut": "3000" };

    @if(session('toast_message'))
        toastr.{{ session('toast_type') }}('{{ session('toast_message') }}');
    @endif

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) { document.getElementById('profilePicturePreview').src = e.target.result; };
            reader.readAsDataURL(input.files[0]);
            
            var dataTransfer = new DataTransfer();
            dataTransfer.items.add(input.files[0]);
            document.getElementById('hiddenFileInput').files = dataTransfer.files;
        }
    }

    document.getElementById('profilePictureInput').addEventListener('change', function() {
        var dataTransfer = new DataTransfer();
        if (this.files[0]) {
            dataTransfer.items.add(this.files[0]);
            document.getElementById('hiddenFileInput').files = dataTransfer.files;
        }
    });
</script>
</body>
</html>