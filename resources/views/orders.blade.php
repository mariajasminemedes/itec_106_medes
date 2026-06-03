<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Directory - Jewelry Order System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700&display=swap" rel="stylesheet">
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

        .table > :not(caption) > * > * {
            padding: 16px 16px;
            border-bottom-color: #f1f5f9;
        }

        .badge-custom {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.725rem;
            letter-spacing: 0.3px;
            display: inline-block;
            text-transform: uppercase;
        }

        /* Form Custom Design Aesthetics */
        .form-label { 
            font-weight: 600; 
            color: #334155; 
            font-size: 0.75rem; 
            text-transform: uppercase; 
            letter-spacing: 0.5px; 
        }

        .form-control, .form-select, .input-group-text { 
            border-radius: 10px; 
            padding: 10px 14px; 
            border: 1px solid #cbd5e1; 
            color: #0f172a;
            font-size: 0.925rem;
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
        }

        /* Action buttons layout */
        .action-btn { 
            width: 32px; 
            height: 32px; 
            padding: 0; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 8px; 
            transition: all 0.2s; 
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
            <a class="nav-link active" href="/orders"><i class="fas fa-fw fa-shopping-cart me-2"></i> Orders</a>
            <a class="nav-link" href="/orders/create"><i class="fas fa-fw fa-plus-circle me-2"></i> Add Order</a>
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
            <a class="nav-link active py-3 px-4" href="/orders"><i class="fas fa-fw fa-shopping-cart me-3"></i> Orders</a>
            <a class="nav-link py-3 px-4 text-muted" href="/orders/create"><i class="fas fa-fw fa-plus-circle me-3"></i> Add Order</a>
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
    
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-5 gap-3">
        <div>
            <h2 class="fw-bold tracking-tight mb-1" style="color: #0f172a;">Orders Master Directory</h2>
            <p class="text-muted mb-0">Monitor financial asset item balances and active order distribution statuses.</p>
        </div>
        <button type="button" class="btn btn-indigo px-4 py-2 text-white shadow-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#addOrderModal" style="background-color: #4f46e5; border-color: #4f46e5;">
            <i class="fas fa-plus me-2"></i>Add New Order
        </button>
    </div>

    <div class="row g-4">
        
        <div class="col-12 col-xl-7">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-4 px-4 border-bottom-0 d-flex align-items-center justify-content-between">
                    <h5 class="m-0 fw-bold text-dark"><i class="fas fa-file-invoice-dollar me-2 text-muted"></i>Financial Ledger Breakdown</h5>
                    <span class="badge bg-light text-indigo border px-2.5 py-1.5 fw-semibold" style="color: #4f46e5;">Billing Metrics</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.8px;">
                                <tr>
                                    <th class="ps-4 text-muted py-3">Customer Name</th>
                                    <th class="text-muted py-3">Jewelry Item</th>
                                    <th class="text-muted py-3">Qty</th>
                                    <th class="text-muted py-3">Unit Price</th>
                                    <th class="text-muted py-3">Total Gross</th>
                                    <th class="text-end pe-4 text-muted py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="p-2 rounded-circle me-2.5 text-center" style="background-color: #f1f5f9; color: #4f46e5; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-user-tie small"></i>
                                                </div>
                                                <span class="fw-semibold text-dark">{{ $order->customer_name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-semibold"><i class="fas fa-crown text-muted me-1 small"></i>{{ $order->jewelry_item }}</span>
                                        </td>
                                        <td><span class="badge bg-light text-secondary border px-2 py-1 fw-medium">{{ $order->quantity }} pcs</span></td>
                                        <td class="text-muted small">₱{{ number_format($order->price, 2) }}</td>
                                        <td class="text-dark fw-bold">₱{{ number_format($order->total_price, 2) }}</td>
                                        <td class="text-end pe-4">
                                            <a href="/orders/{{ $order->id }}/edit" class="btn btn-outline-secondary action-btn me-1 border-light-subtle text-muted" title="Edit Order" style="background: #f8fafc;">
                                                <i class="fas fa-edit small"></i>
                                            </a>
                                            <form action="/orders/{{ $order->id }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger action-btn border-light-subtle" title="Delete Order" style="background: #f8fafc; color: #ef4444;">
                                                    <i class="fas fa-trash-alt small"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <div class="mb-2"><i class="fas fa-inbox fa-2x text-black-50" style="opacity: 0.25;"></i></div>
                                            <h6 class="fw-semibold text-dark">No ledgers documented</h6>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-5">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-4 px-4 border-bottom-0 d-flex align-items-center justify-content-between">
                    <h5 class="m-0 fw-bold text-dark"><i class="fas fa-route me-2 text-muted"></i>Pipeline Status Directory</h5>
                    <span class="text-muted small">Live Flow Logs</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.8px;">
                                <tr>
                                    <th class="ps-4 text-muted py-3">Customer Reference</th>
                                    <th class="text-muted py-3">Status</th>
                                    <th class="pe-4 text-muted py-3">Order Log Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td class="ps-4">
                                            <span class="fw-semibold text-secondary small">#{{ $order->id }}</span> — <span class="text-dark fw-medium">{{ $order->customer_name }}</span>
                                        </td>
                                        <td>
                                            <span class="badge-custom" style="
                                                {{ $order->status == 'Pending' ? 'background-color: #fef3c7; color: #d97706;' : '' }}
                                                {{ $order->status == 'Processing' ? 'background-color: #e0f2fe; color: #0284c7;' : '' }}
                                                {{ $order->status == 'Completed' ? 'background-color: #dcfce7; color: #16a34a;' : '' }}
                                                {{ $order->status == 'Cancelled' ? 'background-color: #fee2e2; color: #dc2626;' : '' }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="pe-4 text-muted small">
                                            {{ date('M d, Y • h:i A', strtotime($order->order_date)) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted">
                                            <div class="mb-2"><i class="fas fa-history fa-2x text-black-50" style="opacity: 0.25;"></i></div>
                                            <h6 class="fw-semibold text-dark">No records found</h6>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            <div class="modal-header px-4 pt-4 border-bottom-0">
                <h5 class="modal-title fw-bold text-dark" id="addOrderModalLabel">
                    <i class="fas fa-plus-circle me-2 text-indigo" style="color: #4f46e5;"></i>Create System Order Record
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form method="POST" action="/orders">
                @csrf
                <div class="modal-body px-4 pb-4">
                    <p class="text-muted small mb-4">Provide customer account metadata and select baseline categories to compile dynamic gross computations.</p>
                    
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Customer Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user small"></i></span>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="E.g. Jane Doe" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="jewelry_item" class="form-label">Jewelry Item Classification</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-crown small"></i></span>
                            <select class="form-select" id="jewelry_item" name="jewelry_item" onchange="updateAutomaticPrice()" required>
                                <option value="" selected disabled>Select an option...</option>
                                <option value="Ring">Ring</option>
                                <option value="Necklace">Necklace</option>
                                <option value="Bracelet">Bracelet</option>
                                <option value="Earrings">Earrings</option>
                                <option value="Pendant">Pendant</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <label for="quantity" class="form-label">Quantity (pcs)</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" oninput="calculateGrossTotal()" required>
                        </div>
                        <div class="col-6">
                            <label for="price" class="form-label">Unit Price (₱)</label>
                            <div class="input-group">
                                <span class="input-group-text fw-semibold" style="border-right: 1px solid #cbd5e1; border-top-right-radius: 0; border-bottom-right-radius: 0;">₱</span>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" placeholder="0.00" oninput="calculateGrossTotal()" required style="border-left: 1px solid #cbd5e1; border-top-left-radius: 0; border-bottom-left-radius: 0; padding-left: 12px;">
                            </div>
                        </div>
                    </div>

                    <div class="p-3 mb-2 border rounded-3 bg-light-subtle d-flex align-items-center justify-content-between">
                        <div class="small fw-semibold text-secondary text-uppercase tracking-wider">Estimated Balance Due:</div>
                        <div class="fs-4 fw-bold text-dark">₱<span id="total_gross">0.00</span></div>
                    </div>
                </div>
                
                <div class="modal-footer px-4 pb-4 pt-0 border-top-0 d-flex gap-2">
                    <button type="button" class="btn btn-light px-4 border text-secondary fw-semibold rounded-3" data-bs-toggle="modal">Cancel</button>
                    <button type="submit" class="btn btn-indigo px-4 text-white fw-semibold rounded-3" style="background-color: #4f46e5; border-color: #4f46e5;">
                        <i class="fas fa-check-circle me-1.5"></i>Log Transaction
                    </button>
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
        toastr.{{ session('toast_type') }}('{{ session('toast_message') }}');
    @endif

    // Unified item pricing catalog configurations
    const priceCatalog = {
        "Ring": 45000.00,
        "Necklace": 62000.00,
        "Bracelet": 15500.00,
        "Earrings": 28000.00,
        "Pendant": 18000.00
    };

    /**
     * Updates baseline structural calculation variables automatically
     */
    function updateAutomaticPrice() {
        const selectedItem = document.getElementById('jewelry_item').value;
        const priceInput = document.getElementById('price');
        
        if (selectedItem && priceCatalog[selectedItem]) {
            priceInput.value = priceCatalog[selectedItem].toFixed(2);
        } else {
            priceInput.value = "";
        }
        calculateGrossTotal();
    }

    /**
     * Live evaluation multiplication functions for the user calculation elements
     */
    function calculateGrossTotal() {
        const unitPrice = parseFloat(document.getElementById('price').value) || 0;
        const quantity = parseInt(document.getElementById('quantity').value) || 1;
        const totalGrossDisplay = document.getElementById('total_gross');
        
        const dynamicTotal = unitPrice * quantity;
        totalGrossDisplay.innerText = dynamicTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }
</script>
</body>
</html>