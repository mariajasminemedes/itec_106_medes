<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order - Jewelry Order System</title>
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

        .form-control:read-only {
            background-color: #f8fafc;
            color: #64748b;
            border-color: #cbd5e1 !important;
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

<div class="sidebar d-none d-lg-flex flex-column justify-content-between">
    <div>
        <div class="p-4 border-bottom border-light">
            <h5 class="mb-0 fw-bold text-dark d-flex align-items-center"><i class="fas fa-gem me-2 text-indigo" style="color: #4f46e5;"></i>Jewelry Shop</h5>
            <small class="text-muted text-uppercase tracking-wider mt-1 d-block" style="font-size: 0.65rem; letter-spacing: 1px;">Management System</small>
        </div>
        
        <nav class="nav flex-column mt-4">
            <a class="nav-link" href="/dashboard"><i class="fas fa-fw fa-chart-pie me-2"></i> Dashboard</a>
            <a class="nav-link" href="/orders"><i class="fas fa-fw fa-shopping-cart me-2"></i> Orders</a>
            <a class="nav-link active" href="/orders/create"><i class="fas fa-fw fa-plus-circle me-2"></i> Add Order</a>
            <a class="nav-link" href="/profile"><i class="fas fa-fw fa-user me-2"></i> My Profile</a>
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

<nav class="navbar navbar-light bg-white border-bottom d-lg-none px-3 sticky-top w-100 shadow-sm">
    <span class="navbar-brand fw-bold text-dark"><i class="fas fa-gem me-2 text-indigo" style="color: #4f46e5;"></i>Jewelry Shop</span>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<div class="offcanvas offcanvas-start bg-white text-dark d-lg-none" tabindex="-1" id="mobileSidebar" style="width: 280px;">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold text-dark"><i class="fas fa-gem me-2 text-indigo" style="color: #4f46e5;"></i>Jewelry Shop</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0 d-flex flex-column justify-content-between">
        <nav class="nav flex-column mt-3">
            <a class="nav-link py-3 px-4 text-muted" href="/dashboard"><i class="fas fa-fw fa-chart-pie me-3"></i> Dashboard</a>
            <a class="nav-link py-3 px-4 text-muted" href="/orders"><i class="fas fa-fw fa-shopping-cart me-3"></i> Orders</a>
            <a class="nav-link active py-3 px-4" href="/orders/create"><i class="fas fa-fw fa-plus-circle me-3"></i> Add Order</a>
            <a class="nav-link py-3 px-4 text-muted" href="/profile"><i class="fas fa-fw fa-user me-3"></i> My Profile</a>
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

<div class="main-content">
    
    <div class="mb-5">
        <h2 class="fw-bold tracking-tight mb-1" style="color: #0f172a;">Add New Order</h2>
        <p class="text-muted mb-0">Create and store a brand new custom jewelry order entry into the system pipeline.</p>
    </div>

    <div class="card shadow-sm border-0" style="max-width: 850px;">
        <div class="card-header bg-white py-4 px-4 border-bottom-0">
            <h5 class="m-0 fw-bold text-dark d-flex align-items-center">
                <i class="fas fa-pen-nib me-2 text-muted" style="font-size: 1.1rem;"></i>Order Details Form
            </h5>
        </div>
        
        <div class="card-body p-4 pt-0">
            
            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-3 p-3 mb-4" style="background-color: #fee2e2; color: #991b1b;">
                    <div class="d-flex align-items-center mb-2 fw-bold">
                        <i class="fas fa-exclamation-circle me-2"></i> Please correct the fields below:
                    </div>
                    <ul class="mb-0 ps-4 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('orders.store') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="customer_name" class="form-label">Customer Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user small"></i></span>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" placeholder="Enter customer name" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="jewelry_item" class="form-label">Jewelry Item Classification</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-crown small"></i></span>
                        <select class="form-select" id="jewelry_item" name="jewelry_item" onchange="updateAutomaticPrice()" required>
                            <option value="">Select an item category</option>
                            <option value="Ring" {{ (old('jewelry_item', request('item')) == 'Ring') ? 'selected' : '' }}>Ring</option>
                            <option value="Necklace" {{ (old('jewelry_item', request('item')) == 'Necklace') ? 'selected' : '' }}>Necklace</option>
                            <option value="Bracelet" {{ (old('jewelry_item', request('item')) == 'Bracelet') ? 'selected' : '' }}>Bracelet</option>
                            <option value="Earrings" {{ (old('jewelry_item', request('item')) == 'Earrings') ? 'selected' : '' }}>Earrings</option>
                        </select>
                    </div>
                </div>
                
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-4">
                        <label for="quantity" class="form-label">Quantity (pcs)</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="{{ old('quantity', 1) }}" oninput="calculateGrossTotal()" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="price" class="form-label">Unit Price (₱)</label>
                        <div class="input-group">
                            <span class="input-group-text fw-semibold" style="border-right: 1px solid #cbd5e1; border-top-right-radius: 0; border-bottom-right-radius: 0;">₱</span>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price', request('price')) }}" placeholder="0.00" readonly required style="border-left: 1px solid #cbd5e1; border-top-left-radius: 0; border-bottom-left-radius: 0; padding-left: 12px;">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="total_gross" class="form-label">Total Gross Cost</label>
                        <div class="input-group">
                            <span class="input-group-text fw-semibold" style="border-right: 1px solid #cbd5e1; border-top-right-radius: 0; border-bottom-right-radius: 0;">₱</span>
                            <input type="text" class="form-control" id="total_gross" readonly placeholder="0.00" style="border-left: 1px solid #cbd5e1; border-top-left-radius: 0; border-bottom-left-radius: 0; padding-left: 12px;">
                        </div>
                    </div>
                </div>
                
                <div class="mb-5">
                    <label for="status" class="form-label">Initial System Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Processing" {{ old('status') == 'Processing' ? 'selected' : '' }}>Processing</option>
                        <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                
                <div class="pt-4 border-top d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary px-4 py-2.5 rounded-3 fw-medium shadow-sm" style="background-color: #4f46e5; border-color: #4f46e5;">
                        <i class="fas fa-save me-2"></i>Save Order Record
                    </button>
                    <a href="/orders" class="btn btn-light px-4 py-2.5 rounded-3 border text-secondary fw-medium">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
    
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // System Pricing Catalog configuration matching the dashboard stock options
    const priceCatalog = {
        "Ring": 45000.00,
        "Necklace": 62000.00,
        "Bracelet": 15500.00,
        "Earrings": 28000.00
    };

    /**
     * Automatically changes the unit price field based on dropdown changes
     */
    function updateAutomaticPrice() {
        const selectedItem = document.getElementById('jewelry_item').value;
        const priceInput = document.getElementById('price');
        
        if (selectedItem && priceCatalog[selectedItem]) {
            priceInput.value = priceCatalog[selectedItem].toFixed(2);
        } else if (!selectedItem) {
            priceInput.value = "";
        }
        
        calculateGrossTotal();
    }

    /**
     * Multiplies Unit Price by Quantity automatically
     */
    function calculateGrossTotal() {
        const unitPrice = parseFloat(document.getElementById('price').value) || 0;
        const quantity = parseInt(document.getElementById('quantity').value) || 1;
        const totalGrossDisplay = document.getElementById('total_gross');
        
        const dynamicTotal = unitPrice * quantity;
        totalGrossDisplay.value = dynamicTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    // Initialize calculations right away when the template is rendered
    window.addEventListener('DOMContentLoaded', () => {
        if(document.getElementById('jewelry_item').value) {
            // If loaded with URL parameters, instantly execute structural values
            calculateGrossTotal();
        }
    });
</script>
</body>
</html>