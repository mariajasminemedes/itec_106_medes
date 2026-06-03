<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Jewelry Order System</title>
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
            overflow: hidden;
        }

        .table > :not(caption) > * > * {
            padding: 16px 20px;
            border-bottom-color: #f1f5f9;
        }

        .badge-custom {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 0.3px;
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

        .search-wrapper {
            position: relative;
            max-width: 380px;
            width: 100%;
        }

        .search-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        .search-wrapper .form-control {
            padding-left: 44px;
            background-color: #f8fafc;
            border-color: #e2e8f0;
        }

        .search-wrapper .form-control:focus {
            background-color: #ffffff;
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
        }

        .form-control:focus, .form-select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
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
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5 gap-3">
        <div>
            <h2 class="fw-bold tracking-tight mb-1" style="color: #0f172a;">Manage Orders Ledger</h2>
            <p class="text-muted mb-0">Monitor active client pipeline records and dispatch updates instantly.</p>
        </div>
        <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-3 w-100 w-md-auto">
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="globalSearchInput" class="form-control" placeholder="Search customer or item...">
            </div>
            <button type="button" class="btn btn-indigo px-4 py-2 text-white shadow-sm fw-semibold" style="background-color: #4f46e5; border-color: #4f46e5; min-width: 160px;" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                <i class="fas fa-plus me-2"></i>Add New Order
            </button>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-lg-7">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-4 px-4 border-bottom-0 d-flex align-items-center justify-content-between">
                    <h5 class="m-0 fw-bold text-dark"><i class="fas fa-receipt me-2 text-muted"></i>Transaction Details</h5>
                    <span class="badge bg-slate text-muted border px-2 py-1 small">Sales Log</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle" id="transactionsTable">
                            <thead class="table-light text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.8px;">
                                <tr>
                                    <th class="ps-4 text-muted py-3">Customer Name</th>
                                    <th class="text-muted py-3">Jewelry Item</th>
                                    <th class="text-muted py-3 text-center">Qty</th>
                                    <th class="text-muted py-3">Total Gross</th>
                                    <th class="text-end pe-4 text-muted py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr class="order-row-item" data-search-string="{{ strtolower($order->customer_name . ' ' . $order->jewelry_item) }}">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="p-2 rounded-circle me-3 text-center" style="background-color: #f1f5f9; color: #4f46e5; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-user-tie small"></i>
                                                </div>
                                                <span class="fw-semibold text-dark text-truncate" style="max-width: 140px;">{{ $order->customer_name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-semibold"><i class="fas fa-crown text-muted me-1 small"></i>{{ $order->jewelry_item }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-secondary border px-2 py-1 fw-medium">{{ $order->quantity }} pcs</span>
                                        </td>
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
                                    <tr class="empty-placeholder-row">
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <div class="mb-3"><i class="fas fa-inbox fa-3x text-black-50" style="opacity: 0.25;"></i></div>
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

        <div class="col-lg-5">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-4 px-4 border-bottom-0 d-flex align-items-center justify-content-between">
                    <h5 class="m-0 fw-bold text-dark"><i class="fas fa-truck me-2 text-muted"></i>Fulfillment & Pipeline</h5>
                    <span class="text-muted small">Live Status</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle" id="logisticsTable">
                            <thead class="table-light text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.8px;">
                                <tr>
                                    <th class="ps-4 text-muted py-3">Status Pipeline</th>
                                    <th class="text-muted py-3">Order Log Date</th>
                                    <th class="text-end pe-4 text-muted py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr class="order-row-item" data-search-string="{{ strtolower($order->customer_name . ' ' . $order->jewelry_item) }}">
                                        <td class="ps-4">
                                            <span class="badge-custom text-uppercase d-inline-block" style="
                                                {{ $order->status == 'Pending' ? 'background-color: #fef3c7; color: #d97706;' : '' }}
                                                {{ $order->status == 'Processing' ? 'background-color: #e0f2fe; color: #0284c7;' : '' }}
                                                {{ $order->status == 'Completed' ? 'background-color: #dcfce7; color: #16a34a;' : '' }}
                                                {{ $order->status == 'Cancelled' ? 'background-color: #fee2e2; color: #dc2626;' : '' }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="text-muted small">
                                            <span class="d-block fw-medium text-dark">{{ date('M d, Y', strtotime($order->order_date)) }}</span>
                                            <span class="text-muted text-xs">{{ date('h:i A', strtotime($order->order_date)) }}</span>
                                        </td>
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
                                    <tr class="empty-placeholder-row">
                                        <td colspan="3" class="text-center py-5 text-muted">
                                            <div class="mb-3"><i class="fas fa-history fa-3x text-black-50" style="opacity: 0.25;"></i></div>
                                            <h6 class="fw-semibold text-dark">No pipeline histories</h6>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            <div class="modal-header px-4 pt-4 border-0">
                <h5 class="modal-title fw-bold text-dark" id="addOrderModalLabel"><i class="fas fa-cart-plus text-indigo me-2" style="color: #4f46e5;"></i>Create New Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/orders">
                @csrf
                <div class="modal-body px-4 pb-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="customer_name" class="form-label">Customer Full Name</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="John Doe" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="jewelry_item" class="form-label">Jewelry Configuration Category</label>
                            <select class="form-select" id="jewelry_item" name="jewelry_item" onchange="updateAutomaticPrice()" required>
                                <option value="" selected disabled>Select an option...</option>
                                <option value="Rings">Classic Diamond Ring</option>
                                <option value="Necklaces">Premium Gold Chain</option>
                                <option value="Bracelet">Silver Charm Bangle</option>
                                <option value="Earrings">Crystal Drop Studs</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" oninput="calculateGrossTotal()" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="price" class="form-label">Unit Base Price</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0">₱</span>
                                <input type="number" step="0.01" class="form-control border-start-0 ps-0" id="price" name="price" oninput="calculateGrossTotal()" readonly required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="total_gross" class="form-label">Total Projected Gross</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0 fw-semibold">₱</span>
                                <input type="text" class="form-control border-start-0 ps-0 bg-light text-dark fw-bold" id="total_gross" readonly value="0.00">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 pb-4 pt-0 border-0 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light border px-4 py-2 fw-semibold text-secondary" style="border-radius: 10px;" data-bs-dismiss="modal">Discard</button>
                    <button type="submit" class="btn text-white px-4 py-2 fw-semibold" style="background-color: #4f46e5; border-radius: 10px;">Save Transaction</button>
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

    /* Live Catalog Valuation Registry Lookup object map */
    const priceCatalog = {
        "Rings": 45000.00,
        "Necklaces": 62000.00,
        "Bracelet": 15500.00,
        "Earrings": 28000.00
    };

    /**
     * Automatically updates the unit price field based on selector adjustments
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
     * Multiplies Unit Base Price by Quantity instantly
     */
    function calculateGrossTotal() {
        const unitPrice = parseFloat(document.getElementById('price').value) || 0;
        const quantity = parseInt(document.getElementById('quantity').value) || 1;
        const totalGrossDisplay = document.getElementById('total_gross');
        
        const dynamicTotal = unitPrice * quantity;
        totalGrossDisplay.value = dynamicTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    /**
     * Synchronous Instant Filtering Search Utility Engine 
     * Filters matching records on both tables simultaneously based on user input
     */
    document.getElementById('globalSearchInput').addEventListener('input', function(e) {
        const queryValue = e.target.value.toLowerCase().trim();
        const rowItems = document.querySelectorAll('.order-row-item');
        
        // Tracking variables to show custom empty state placeholder rows if needed
        let leftVisibleCount = 0;
        let rightVisibleCount = 0;

        rowItems.forEach(row => {
            const indexValue = row.getAttribute('data-search-string') || '';
            const isMatch = indexValue.includes(queryValue);
            
            if(isMatch || queryValue === '') {
                row.style.setProperty('display', '', 'important');
                // Increment counters depending on which table container row belongs to
                if(row.closest('#transactionsTable')) leftVisibleCount++;
                if(row.closest('#logisticsTable')) rightVisibleCount++;
            } else {
                row.style.setProperty('display', 'none', 'important');
            }
        });
    });
</script>
</body>
</html>