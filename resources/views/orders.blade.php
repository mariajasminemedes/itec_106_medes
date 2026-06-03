<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Ledger - Jewelry Order System</title>
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
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.006);
            transition: box-shadow 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -2px rgba(0, 0, 0, 0.01);
        }

        .table > :not(caption) > * > * {
            padding: 16px 16px;
            border-bottom-color: #f1f5f9;
        }

        .table th {
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
        }

        .badge-custom {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.72rem;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
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

        .action-btn:hover {
            transform: translateY(-1px);
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
            <h5 class="mb-0 fw-bold text-dark d-flex align-items-center"><i class="fas fa-gem me-2" style="color: #4f46e5;"></i>Jewelry Shop</h5>
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
    <span class="navbar-brand fw-bold text-dark"><i class="fas fa-gem me-2" style="color: #4f46e5;"></i>Jewelry Shop</span>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<div class="offcanvas offcanvas-start bg-white text-dark d-lg-none" tabindex="-1" id="mobileSidebar" style="width: 280px;">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold text-dark"><i class="fas fa-gem me-2" style="color: #4f46e5;"></i>Jewelry Shop</h5>
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
            <h2 class="fw-bold tracking-tight mb-1" style="color: #0f172a;">Orders Console</h2>
            <p class="text-muted mb-0">Track customer production lifecycle events and processing pipelines in real-time.</p>
        </div>
        <a href="/orders/create" class="btn btn-primary px-4 py-2.5 shadow-sm fw-semibold d-flex align-items-center gap-2" style="background-color: #4f46e5; border-color: #4f46e5; border-radius: 10px;">
            <i class="fas fa-plus-circle"></i>Add New Order
        </a>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4 px-4 border-bottom-0 d-flex align-items-center justify-content-between">
                    <h5 class="m-0 fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="fas fa-file-invoice-dollar text-muted" style="font-size: 1.1rem;"></i>Master Orders Console
                    </h5>
                    <span class="badge bg-light text-secondary border px-2.5 py-1.5 fw-semibold" style="font-size: 0.75rem;">
                        {{ count($orders) }} Active Records
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4 py-3">Jewelry Item</th>
                                    <th class="py-3 text-center">Qty</th>
                                    <th class="py-3 text-end">Unit Price</th>
                                    <th class="py-3 text-end">Total Gross</th>
                                    <th class="py-3 text-center">Current Status</th>
                                    <th class="py-3 text-center">Order Date &amp; Time</th>
                                    <th class="text-end pe-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td class="ps-4">
                                            <span class="text-dark fw-semibold" style="font-size: 0.88rem;">
                                                <i class="fas fa-crown text-muted me-1.5 small"></i>{{ $order->jewelry_item }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-secondary border px-2 py-1.5 fw-medium" style="font-size: 0.8rem;">
                                                {{ $order->quantity }} pcs
                                            </span>
                                        </td>
                                        <td class="text-end text-muted small fw-medium">₱{{ number_format($order->price, 2) }}</td>
                                        <td class="text-end text-dark fw-bold" style="font-size: 0.9rem;">₱{{ number_format($order->total_price, 2) }}</td>
                                        <td class="text-center">
                                            <span class="badge-custom text-uppercase" style="
                                                {{ $order->status == 'Pending' ? 'background-color: #fef3c7; color: #d97706;' : '' }}
                                                {{ $order->status == 'Processing' ? 'background-color: #e0f2fe; color: #0284c7;' : '' }}
                                                {{ $order->status == 'Completed' ? 'background-color: #dcfce7; color: #16a34a;' : '' }}
                                                {{ $order->status == 'Cancelled' ? 'background-color: #fee2e2; color: #dc2626;' : '' }}">
                                                <i class="fas fa-circle" style="font-size: 0.45rem; opacity: 0.75;"></i>
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-muted small fw-medium d-block" style="font-size: 0.8rem;">
                                                {{ date('M d, Y', strtotime($order->order_date)) }}
                                            </span>
                                            <span class="text-black-50 d-block" style="font-size: 0.7rem;">
                                                {{ date('h:i A', strtotime($order->order_date)) }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="d-flex justify-content-end gap-1">
                                                <a href="/orders/{{ $order->id }}/edit" class="btn btn-sm btn-outline-secondary action-btn border-light-subtle text-muted" title="Modify Record" style="background: #f8fafc;">
                                                    <i class="fas fa-edit small"></i>
                                                </a>
                                                
                                                <form action="/orders/{{ $order->id }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger action-btn border-light-subtle" title="Purge Record" style="background: #f8fafc; color: #ef4444;">
                                                        <i class="fas fa-trash-alt small"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">
                                            <div class="mb-3"><i class="fas fa-inbox fa-3x text-black-50" style="opacity: 0.15;"></i></div>
                                            <h6 class="fw-semibold text-dark">No orders found</h6>
                                            <p class="text-muted small mb-0">Click "Add New Order" to create a pipeline record.</p>
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
</script>
</body>
</html>