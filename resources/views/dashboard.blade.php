<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Jewelry Order System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { 
            background-color: #f8f9fa; 
            font-family: 'Inter', sans-serif;
            color: #343a40;
        }
        
        /* Sidebar Styling */
        .sidebar { 
            width: 260px; 
            background: #0f172a; /* Sleek Dark Slate Slate */
            min-height: 100vh;
            transition: all 0.3s;
        }
        .sidebar .nav-link { 
            color: #94a3b8; 
            padding: 12px 20px; 
            margin: 4px 15px; 
            border-radius: 8px; 
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { 
            background-color: rgba(255, 255, 255, 0.08); 
            color: #ffffff; 
        }
        .sidebar .nav-link.active {
            font-weight: 600;
        }

        /* Card Simplifications */
        .card { 
            border: 1px solid #e2e8f0; 
            border-radius: 12px; 
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
        }
        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        /* Responsive Layout Behavior */
        @media (min-width: 992px) {
            .wrapper { display: flex; }
            .main-content { flex: 1; min-width: 0; padding: 40px; }
            .sidebar-wrapper { position: sticky; top: 0; height: 100vh; z-index: 1020; }
        }
        @media (max-width: 991.98px) {
            .main-content { padding: 20px; }
            .sidebar { width: 100%; min-height: auto; }
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar-wrapper d-none d-lg-block">
        <div class="sidebar d-flex flex-column">
            <div class="text-white p-4 border-bottom border-secondary border-opacity-25">
                <h5 class="mb-0 fw-bold"><i class="fas fa-gem me-2 text-info"></i>Jewelry Shop</h5>
                <small class="text-muted text-uppercase tracking-wider" style="font-size: 0.65rem;">Management</small>
            </div>
            
            <nav class="nav flex-column mt-3 flex-grow-1">
                <a class="nav-link active" href="/dashboard"><i class="fas fa-fw fa-home me-2"></i> Dashboard</a>
                <a class="nav-link" href="/orders"><i class="fas fa-fw fa-shopping-cart me-2"></i> Orders</a>
                <a class="nav-link" href="/orders/create"><i class="fas fa-fw fa-plus-circle me-2"></i> Add Order</a>
                <a class="nav-link" href="/profile"><i class="fas fa-fw fa-user me-2"></i> My Profile</a>
            </nav>

            <div class="p-3 border-top border-secondary border-opacity-25">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link text-start text-decoration-none w-100 py-2 px-3 text-muted nav-link m-0">
                        <i class="fas fa-sign-out-alt me-2"></i> Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-dark bg-dark d-lg-none px-3 sticky-top w-100">
        <span class="navbar-brand fw-bold"><i class="fas fa-gem me-2 text-info"></i>Jewelry Shop</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="offcanvas offcanvas-start bg-dark text-white d-lg-none" tabindex="-1" id="mobileSidebar" style="width: 280px;">
        <div class="offcanvas-header border-bottom border-secondary border-opacity-25">
            <h5 class="offcanvas-title fw-bold text-white"><i class="fas fa-gem me-2 text-info"></i>Jewelry Shop</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0 d-flex flex-column bg-dark sidebar">
            <nav class="nav flex-column mt-3 flex-grow-1">
                <a class="nav-link active" href="/dashboard"><i class="fas fa-fw fa-home me-2"></i> Dashboard</a>
                <a class="nav-link" href="/orders"><i class="fas fa-fw fa-shopping-cart me-2"></i> Orders</a>
                <a class="nav-link" href="/orders/create"><i class="fas fa-fw fa-plus-circle me-2"></i> Add Order</a>
                <a class="nav-link" href="/profile"><i class="fas fa-fw fa-user me-2"></i> My Profile</a>
            </nav>
            <div class="p-3 border-top border-secondary border-opacity-25">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link text-start text-decoration-none w-100 py-2 px-3 text-muted nav-link m-0">
                        <i class="fas fa-sign-out-alt me-2"></i> Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="main-content w-100">
        
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
            <div>
                <h3 class="fw-bold tracking-tight mb-1">Overview Dashboard</h3>
                <p class="text-muted small mb-0">Welcome back, <span class="fw-semibold text-dark">{{ Auth::user()->username }}</span>! Ready to manage your jewelry assets.</p>
            </div>
            <a href="/orders/create" class="btn btn-dark px-4 shadow-sm w-100 w-sm-auto">
                <i class="fas fa-plus me-2"></i>Place New Order
            </a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <div class="card stat-card bg-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase text-muted fw-semibold mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Orders Tracked</div>
                            <div class="h2 mb-0 fw-bold text-dark">{{ $totalOrders }}</div>
                        </div>
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                            <i class="fas fa-boxes fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card stat-card bg-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase text-muted fw-semibold mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Pending Shipments</div>
                            <div class="h2 mb-0 fw-bold text-dark">{{ $pendingOrders }}</div>
                        </div>
                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                            <i class="fas fa-clock fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card stat-card bg-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase text-muted fw-semibold mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Orders Processing</div>
                            <div class="h2 mb-0 fw-bold text-dark">{{ $processingOrders }}</div>
                        </div>
                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                            <i class="fas fa-spinner fa-spin fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-white">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-list me-2 text-muted"></i>Recent Purchases Inventory</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light text-uppercase fs-7" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                            <tr>
                                <th class="ps-4 text-muted py-3">Jewelry Item</th>
                                <th class="text-muted py-3">Quantity</th>
                                <th class="text-muted py-3">Unit Price</th>
                                <th class="text-muted py-3">Status</th>
                                <th class="pe-4 text-muted py-3">Date Ordered</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light p-2 rounded-3 me-3 text-secondary">
                                                <i class="fas fa-crown"></i>
                                            </div>
                                            <span class="fw-semibold text-dark">{{ $order->jewelry_item }}</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border px-2 py-1 fw-normal">{{ $order->quantity }} pcs</span></td>
                                    <td><span class="text-dark fw-semibold">₱{{ number_format($order->price, 2) }}</span></td>
                                    <td>
                                        <span class="badge px-2.5 py-1.5 rounded-2 text-uppercase fs-8" style="font-size: 0.7rem; font-weight: 600;
                                            {{ $order->status == 'Pending' ? 'background-color: #fef3c7; color: #d97706;' : '' }}
                                            {{ $order->status == 'Processing' ? 'background-color: #e0f2fe; color: #0284c7;' : '' }}
                                            {{ $order->status == 'Completed' ? 'background-color: #dcfce7; color: #16a34a;' : '' }}
                                            {{ $order->status == 'Cancelled' ? 'background-color: #fee2e2; color: #dc2626;' : '' }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="text-muted pe-4 small">{{ date('M d, Y • h:i A', strtotime($order->order_date)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <div class="mb-2"><i class="fas fa-folder-open fa-2x text-body-tertiary"></i></div>
                                        <span class="small">No entries found in your history yet.</span>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>