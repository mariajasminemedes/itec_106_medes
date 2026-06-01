<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Jewelry Order System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Fixed Sidebar Layout Matching System Theme */
        .sidebar { 
            position: fixed; 
            top: 0; 
            left: 0; 
            bottom: 0; 
            width: 260px; 
            background: linear-gradient(180deg, #4e73df 0%, #224abe 100%); 
            z-index: 100;
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
        }
        .sidebar .nav-link { 
            color: rgba(255,255,255,0.75); 
            padding: 12px 20px; 
            margin: 4px 15px; 
            border-radius: 8px; 
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .sidebar .nav-link:hover { 
            background-color: rgba(255,255,255,0.1); 
            color: #ffffff; 
        }
        .sidebar .nav-link.active { 
            background-color: rgba(255,255,255,0.2); 
            color: #ffffff; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Main Workspace Adjustment */
        .main-content { margin-left: 260px; padding: 40px; }
        
        /* Modern Cards and Layout Design */
        .card { border: none; border-radius: 12px; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.05); }
        .form-label { font-weight: 600; color: #4e73df; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-control, .form-select { border-radius: 8px; padding: 10px 15px; border: 1px solid #d1d3e2; transition: all 0.2s; }
        .form-control:focus, .form-select:focus { border-color: #4e73df; box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15); }
        
        /* Profile Image Styles */
        .profile-picture-container { position: relative; display: inline-block; }
        .profile-picture-preview { 
            width: 140px; 
            height: 140px; 
            border-radius: 50%; 
            object-fit: cover; 
            border: 4px solid #ffffff; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.15); 
            transition: transform 0.2s;
        }
        .upload-btn-wrapper { position: relative; overflow: hidden; display: inline-block; }
        .upload-btn-wrapper input[type=file] { position: absolute; left: 0; top: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    </style>
</head>
<body>

    <div class="sidebar d-flex flex-column p-0">
        <div class="text-white p-4 border-bottom border-white-50 border-opacity-10">
            <h5 class="mb-0 font-weight-bold"><i class="fas fa-gem me-2"></i>Jewelry Shop</h5>
            <small class="text-white-50">Management Dashboard</small>
        </div>
        
        <nav class="nav flex-column mt-3 flex-grow-1">
            <a class="nav-link" href="/dashboard"><i class="fas fa-fw fa-home me-2"></i> Dashboard</a>
            <a class="nav-link" href="/orders"><i class="fas fa-fw fa-shopping-cart me-2"></i> Orders</a>
            <a class="nav-link" href="/orders/create"><i class="fas fa-fw fa-plus-circle me-2"></i> Add Order</a>
            <a class="nav-link active" href="/profile"><i class="fas fa-fw fa-user me-2"></i> My Profile</a>
        </nav>

        <div class="p-3 border-top border-white-50 border-opacity-10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100 py-2 border-0 opacity-75 hover-opacity-100 text-start px-3">
                    <i class="fas fa-sign-out-alt me-2"></i> Sign Out
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        
        <div class="mb-4">
            <h3 class="text-gray-800 font-weight-bold mb-0">My Profile</h3>
            <p class="text-muted small mb-0">Manage account information, contact credentials, and avatar preferences.</p>
        </div>

        <div class="row">
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card p-3">
                    <div class="card-body text-center py-4">
                        <div class="profile-picture-container mb-3">
                            <img src="{{ asset('storage/uploads/' . ($user->profile_picture ?? 'default-avatar.png')) }}" 
                                 alt="Profile Picture" 
                                 class="profile-picture-preview"
                                 id="profilePicturePreview">
                        </div>
                        
                        <h4 class="font-weight-bold text-gray-800 mb-1">{{ $user->username }}</h4>
                        <p class="text-muted small mb-4"><i class="fas fa-envelope me-1"></i> {{ $user->email }}</p>
                        
                        <div class="upload-btn-wrapper">
                            <button class="btn btn-sm btn-outline-primary px-3 rounded-pill">
                                <i class="fas fa-camera me-2"></i>Change Profile Picture
                            </button>
                            <input type="file" id="profilePictureInput" accept="image/*" onchange="previewImage(this)">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-user-cog me-2 text-secondary"></i>Account Information</h6>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
                            @csrf
                            @method('PUT')
                            <input type="file" name="profile_picture" id="hiddenFileInput" style="display: none;">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted"><i class="fas fa-user small"></i></span>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->username) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted"><i class="fas fa-envelope small"></i></span>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted"><i class="fas fa-phone small"></i></span>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter contact number">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted"><i class="fas fa-venus-mars small"></i></span>
                                        <select class="form-select" id="gender" name="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-calendar-alt small"></i></span>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}">
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="address" class="form-label">Complete Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-map-marked-alt small"></i></span>
                                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter residential address">{{ old('address', $user->address) }}</textarea>
                                </div>
                            </div>
                            
                            <div class="pt-3 border-top d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                    <i class="fas fa-save me-2"></i>Update Profile
                                </button>
                                <a href="/dashboard" class="btn btn-light px-4 border text-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
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