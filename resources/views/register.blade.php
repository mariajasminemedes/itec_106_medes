<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Jewelry Order System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .register-card {
            width: 100%;
            max-width: 580px;
            padding: 24px;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.04), 0 8px 10px -6px rgba(15, 23, 42, 0.04);
            overflow: hidden;
        }

        .brand-icon-wrapper {
            width: 48px;
            height: 48px;
            background-color: rgba(79, 70, 229, 0.08);
            color: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.25rem;
            margin: 0 auto 16px auto;
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

        /* Gender Radio Button Styling */
        .form-check-input:checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }
        
        .form-check-label {
            font-size: 0.95rem;
            color: #334155;
            font-weight: 500;
        }

        .btn-indigo {
            background-color: #4f46e5;
            border-color: #4f46e5;
            color: #ffffff;
            font-weight: 600;
            padding: 11px 20px;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .btn-indigo:hover {
            background-color: #4338ca;
            border-color: #4338ca;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        .link-indigo {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .link-indigo:hover {
            color: #4338ca;
            text-decoration: underline;
        }
        
        .divider-text {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            font-weight: 700;
            margin: 24px 0;
            display: flex;
            align-items: center;
            text-align: center;
        }

        .divider-text::before, .divider-text::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }

        .divider-text::before { margin-right: .75em; }
        .divider-text::after { margin-left: .75em; }
    </style>
</head>
<body>

    <div class="register-card">
        <div class="card border-0">
            <div class="card-body p-4 p-sm-5">
                
                <!-- System Header Branding -->
                <div class="text-center mb-4">
                    <div class="brand-icon-wrapper">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1">Create Account</h4>
                    <p class="text-muted small mb-0">Join the Jewelry Shop Management System</p>
                </div>
                
                <!-- Laravel Validation Error Alert Block -->
                @if ($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4 small p-3" style="background-color: #fef2f2; color: #991b1b;">
                        <div class="fw-bold mb-1"><i class="fas fa-exclamation-circle me-2"></i>Please correct the following errors:</div>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf
                    
                    <!-- Account Credentials Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user small"></i></span>
                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Choose username" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope small"></i></span>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                            </div>
                        </div>
                    </div>

                    <!-- Passwords Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock small"></i></span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirm Password *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-shield-alt small"></i></span>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                            </div>
                        </div>
                    </div>

                    <!-- Form Section Divider -->
                    <div class="divider-text">Optional Profile Details</div>

                    <!-- Contact & DOB Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone small"></i></span>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt small"></i></span>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Gender Radio Inputs -->
                    <div class="mb-3">
                        <label class="form-label d-block mb-2">Gender</label>
                        <div class="pt-1">
                            <div class="form-check form-check-inline me-4">
                                <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="genderMale">Male</label>
                            </div>
                            <div class="form-check form-check-inline me-4">
                                <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="genderFemale">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderOther" value="Other" {{ old('gender') == 'Other' ? 'checked' : '' }}>
                                <label class="form-check-label" for="genderOther">Other</label>
                            </div>
                        </div>
                    </div>

                    <!-- Address Input Block -->
                    <div class="mb-4">
                        <label for="address" class="form-label">Complete Address</label>
                        <div class="input-group">
                            <span class="input-group-text align-items-start pt-2.5"><i class="fas fa-map-marked-alt small"></i></span>
                            <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter residential address" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">{{ old('address') }}</textarea>
                        </div>
                    </div>
                    
                    <!-- Form Submission Control -->
                    <button type="submit" class="btn btn-indigo w-100 mb-4 shadow-sm">
                        <i class="fas fa-user-plus me-2"></i>Register Account
                    </button>
                    
                    <!-- Footer Link Back to Sign In -->
                    <div class="text-center">
                        <p class="text-muted small mb-0">Already have an account? <a href="/login" class="link-indigo">Login here</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>