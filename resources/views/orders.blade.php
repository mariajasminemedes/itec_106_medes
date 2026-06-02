<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Jewelry Order System</title>
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
        
        /* Item Catalog Display Designs */
        .item-card { 
            transition: transform 0.2s ease, box-shadow 0.2s ease; 
            border: 1px solid #e2e8f0; 
            overflow: hidden;
        }
        .item-card:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 10px 20px rgba(0,0,0,0.04); 
        }
        .item-img-wrapper { 
            height: 140px; 
            overflow: hidden; 
            position: relative; 
            background-color: #f1f5f9; 
        }
        .item-img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
        }
        .item-category { 
            position: absolute; 
            top: 10px; 
            left: 10px; 
            font-size: 0.65rem; 
            font-weight: 700; 
            text-transform: uppercase; 
            letter-spacing: 0.5px; 
            padding: 4px 8px;
            border-radius: 6px;
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

<!-- MAIN VIEW CONTENT CONTENT BLOCK -->
<div class="main-content">
    
    <!-- Welcome Header Module -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-5 gap-3">
        <div>
            <h2 class="fw-bold tracking-tight mb-1" style="color: #0f172a;">Manage Orders &amp; Catalog</h2>
            <p class="text-muted mb-0">View stock item options alongside active customer transaction ledgers.</p>
        </div>
        <a href="/orders/create" class="btn btn-indigo px-4 py-2 text-white shadow-sm fw-semibold" style="background-color: #4f46e5; border-color: #4f46e5;">
            <i class="fas fa-plus me-2"></i>Add New Order
        </a>
    </div>

    <div class="row g-4">
        <!-- Stock Catalog Left Column Layout -->
        <div class="col-12 col-xl-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white py-4 px-4 border-bottom-0 d-flex align-items-center justify-content-between">
                    <h5 class="m-0 fw-bold text-dark"><i class="fas fa-boxes text-muted me-2"></i>Available Stock Options</h5>
                    <span class="badge bg-light text-indigo border px-2.5 py-1.5 fw-semibold" style="color: #4f46e5;">4 Items</span>
                </div>
                <div class="card-body p-3 bg-light-subtle">
                    <div class="row g-3">
                        
                        <!-- Item 1: Ring -->
                        <div class="col-12 col-md-6 col-xl-12">
                            <div class="card item-card h-100 bg-white shadow-sm">
                                <div class="item-img-wrapper">
                                    <span class="badge bg-dark item-category">Ring</span>
                                    <img src="https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=400&q=80" class="item-img" alt="Luxury Ring">
                                </div>
                                <div class="card-body p-3 d-flex flex-column">
                                    <h6 class="fw-bold text-dark mb-1">Classic Diamond Ring</h6>
                                    <p class="text-muted small mb-3" style="font-size: 0.8rem; line-height: 1.4;">18k white gold band set with a brilliant-cut center diamond stone.</p>
                                    <div class="mt-auto d-flex align-items-center justify-content-between">
                                        <span class="fw-bold text-dark">₱45,000.00</span>
                                        <button type="button" onclick="selectCatalogItem('Ring', 45000)" class="btn btn-sm btn-outline-primary px-2.5 py-1 rounded-3 fw-semibold style-button" style="font-size: 0.75rem; border-color: #e2e8f0; color: #4f46e5;">
                                            <i class="fas fa-cart-plus me-1"></i>Select
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 2: Necklace -->
                        <div class="col-12 col-md-6 col-xl-12">
                            <div class="card item-card h-100 bg-white shadow-sm">
                                <div class="item-img-wrapper">
                                    <span class="badge bg-dark item-category">Necklace</span>
                                    <img src="https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=400&q=80" class="item-img" alt="Gold Chain">
                                </div>
                                <div class="card-body p-3 d-flex flex-column">
                                    <h6 class="fw-bold text-dark mb-1">Premium Gold Chain</h6>
                                    <p class="text-muted small mb-3" style="font-size: 0.8rem; line-height: 1.4;">Solid 24k gold interlocking chain mesh meticulously hand-polished.</p>
                                    <div class="mt-auto d-flex align-items-center justify-content-between">
                                        <span class="fw-bold text-dark">₱62,000.00</span>
                                        <button type="button" onclick="selectCatalogItem('Necklace', 62000)" class="btn btn-sm btn-outline-primary px-2.5 py-1 rounded-3 fw-semibold style-button" style="font-size: 0.75rem; border-color: #e2e8f0; color: #4f46e5;">
                                            <i class="fas fa-cart-plus me-1"></i>Select
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3: Bracelet -->
                        <div class="col-12 col-md-6 col-xl-12">
                            <div class="card item-card h-100 bg-white shadow-sm">
                                <div class="item-img-wrapper">
                                    <span class="badge bg-dark item-category">Bracelet</span>
                                    <img src="https://images.unsplash.com/photo-1611591437281-460bfbe1220a?w=400&q=80" class="item-img" alt="Silver Bangle">
                                </div>
                                <div class="card-body p-3 d-flex flex-column">
                                    <h6 class="fw-bold text-dark mb-1">Silver Charm Bangle</h6>
                                    <p class="text-muted small mb-3" style="font-size: 0.8rem; line-height: 1.4;">Elegant Sterling 925 silver bracelet with adjustable custom layout anchors.</p>
                                    <div class="mt-auto d-flex align-items-center justify-content-between">
                                        <span class="fw-bold text-dark">₱15,500.00</span>
                                        <button type="button" onclick="selectCatalogItem('Bracelet', 15500)" class="btn btn-sm btn-outline-primary px-2.5 py-1 rounded-3 fw-semibold style-button" style="font-size: 0.75rem; border-color: #e2e8f0; color: #4f46e5;">
                                            <i class="fas fa-cart-plus me-1"></i>Select
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 4: Earrings -->
                        <div class="col-12 col-md-6 col-xl-12">
                            <div class="card item-card h-100 bg-white shadow-sm">
                                <div class="item-img-wrapper">
                                    <span class="badge bg-dark item-category">Earrings</span>
                                    <img src="https://images.unsplash.com/photo-1635767798638-3e25273a8236?w=400&q=80" class="item-img" alt="Crystal Drops">
                                </div>
                                <div class="card-body p-3 d-flex flex-column">
                                    <h6 class="fw-bold text-dark mb-1">Crystal Drop Studs</h6>
                                    <p class="text-muted small mb-3" style="font-size: 0.8rem; line-height: 1.4;">Exquisite sapphire chandelier drops optimized for premium gala statement aesthetics.</p>
                                    <div class="mt-auto d-flex align-items-center justify-content-between">
                                        <span class="fw-bold text-dark">₱28,000.00</span>
                                        <button type="button" onclick="selectCatalogItem('Earrings', 28000)" class="btn btn-sm btn-outline-primary px-2.5 py-1 rounded-3 fw-semibold style-button" style="font-size: 0.75rem; border-color: #e2e8f0; color: #4f46e5;">
                                            <i class="fas fa-cart-plus me-1"></i>Select
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table Right Column Layout -->
        <div class="col-12 col-xl-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-4 px-4 border-bottom-0 d-flex align-items-center justify-content-between">
                    <h5 class="m-0 fw-bold text-dark"><i class="fas fa-table me-2 text-muted"></i>Orders Ledger Directory</h5>
                    <span class="text-muted small">Live Data Stream</span>
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
                                    <th class="text-muted py-3">Status</th>
                                    <th class="text-muted py-3">Order Date</th>
                                    <th class="text-end pe-4 text-muted py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="p-2 rounded-circle me-3 text-center" style="background-color: #f1f5f9; color: #4f46e5; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-user-tie small"></i>
                                                </div>
                                                <span class="fw-semibold text-dark">{{ $order->customer_name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-semibold"><i class="fas fa-crown text-muted me-1 small"></i>{{ $order->jewelry_item }}</span>
                                        </td>
                                        <td><span class="badge bg-light text-secondary border px-2.5 py-1.5 fw-medium">{{ $order->quantity }} pcs</span></td>
                                        <td class="text-muted small">₱{{ number_format($order->price, 2) }}</td>
                                        <td class="text-dark fw-semibold">₱{{ number_format($order->total_price, 2) }}</td>
                                        <td>
                                            <span class="badge-custom text-uppercase d-inline-block" style="
                                                {{ $order->status == 'Pending' ? 'background-color: #fef3c7; color: #d97706;' : '' }}
                                                {{ $order->status == 'Processing' ? 'background-color: #e0f2fe; color: #0284c7;' : '' }}
                                                {{ $order->status == 'Completed' ? 'background-color: #dcfce7; color: #16a34a;' : '' }}
                                                {{ $order->status == 'Cancelled' ? 'background-color: #fee2e2; color: #dc2626;' : '' }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="text-muted small">{{ date('M d, Y • h:i A', strtotime($order->order_date)) }}</td>
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
                                        <td colspan="8" class="text-center py-5 text-muted">
                                            <div class="mb-3"><i class="fas fa-inbox fa-3x text-black-50" style="opacity: 0.25;"></i></div>
                                            <h6 class="fw-semibold text-dark">No orders found</h6>
                                            <p class="text-muted small mb-0">Click the "Add New Order" button to append a record to your database.</p>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = { "closeButton": true, "progressBar": true, "positionClass": "toast-top-right", "timeOut": "3000" };

    @if(session('toast_message'))
        toastr.{{ session('toast_type') }}('{{ session('toast_message') }}');
    @endif

    /**
     * Automated Selection Handler
     * Redirects cleanly to the creation form with preset item specifications.
     */
    function selectCatalogItem(itemName, unitPrice) {
        const createUrl = `/orders/create?item=${encodeURIComponent(itemName)}&price=${unitPrice}`;
        window.location.href = createUrl;
    }
</script>
</body>
</html>