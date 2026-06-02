<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jewelry Order System</title>
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-card {
            width: 100%;
            max-width: 440px;
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

        .form-control, .input-group-text {
            border-radius: 10px;
            padding: 11px 16px;
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

        .input-group > .form-control {
            border-left: none;
        }

        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            color: #0f172a;
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
    </style>
</head>
<body>

    <div class="login-card">
        <div class="card border-0">
            <div class="card-body p-4 p-sm-5">
                
                <!-- System Header Branding -->
                <div class="text-center mb-4">
                    <div class="brand-icon-wrapper">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1">Jewelry Shop</h4>
                    <p class="text-muted small mb-0">Management Dashboard System</p>
                </div>
                
                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf 
                    
                    <!-- Username Group Field -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user small"></i></span>
                            <input type="text" class="form-control" id="username" name="username" required autofocus value="{{ old('username') }}" placeholder="Enter username">
                        </div>
                    </div>
                    
                    <!-- Password Group Field -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label mb-0">Password</label>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock small"></i></span>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="••••••••">
                        </div>
                    </div>
                    
                    <!-- Form Submission Control -->
                    <button type="submit" class="btn btn-indigo w-100 mb-4 shadow-sm">
                        <i class="fas fa-sign-in-alt me-2"></i>Sign In
                    </button>
                    
                    <!-- Footer Helper Action -->
                    <div class="text-center">
                        <p class="text-muted small mb-0">Don't have an account? <a href="/register" class="link-indigo">Register here</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
    toastr.options = { "closeButton": true, "progressBar": true, "positionClass": "toast-top-right", "timeOut": "3000" };
    
    @if(session('toast_message'))
        toastr.{{ session('toast_type') }}("{{ session('toast_message') }}");
    @endif
    </script>
</body>
</html>