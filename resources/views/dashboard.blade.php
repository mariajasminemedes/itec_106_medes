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
            background-color: #f1f5f9; 
            font-family: 'Inter', sans-serif;
            color: #1e293b;
        }
        
        /* Sidebar layout styling */
        .sidebar { 
            width: 260px; 
            background: #0f172a; 
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
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
            background-color: #3b82f6;
            color: #ffffff;
        }

        /* Main view content wrappers */
        .main-content { 
            margin-left: 260px;
            padding: 40px; 
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* UI Cards Upgrade */
        .card { 
            background: #ffffff;
            border: 1px solid #e2e8f0; 
            border-radius: 14px; 
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
        }
        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        }

        .chart-container {
            position: relative;
            margin: auto;
            height: 260px;
            width: 100%;
        }

        /* Media Queries for Mobile Responsiveness */
        @media (max-width: 991.98px) {
            .sidebar {
                margin-left: -260px;
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            .sidebar.show {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<div class="sidebar d-flex flex-column d-none d-lg-flex">
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
    <div class="offcanvas-body p-0 d-flex flex-column bg-dark">
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

<div class="main-content">
    
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold tracking-tight mb-1">Overview Dashboard</h3>
            <p class="text-muted small mb-0">Welcome back, <span class="fw-semibold text-dark">{{ Auth::user()->username }}</span>! Ready to manage your jewelry assets.</p>
        </div>
        <a href="/orders/create" class="btn btn-dark px-4 shadow-sm w-100 w-sm-auto py-2.5 rounded-3">
            <i class="fas fa-plus me-2"></i>Place New Order
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card stat-card p-4">
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
            <div class="card stat-card p-4">
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
            <div class="card stat-card p-4">
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

    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card p-4 h-100">
                <h6 class="fw-bold mb-3"><i class="fas fa-chart-line text-muted me-2"></i>Order Distribution & Trends</h6>
                <div class="chart-container">
                    <canvas id="revenueTrendChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card p-4 h-100">
                <h6 class="fw-bold mb-3"><i class="fas fa-chart-pie text-muted me-2"></i>Status Summary Breakdown</h6>
                <div class="chart-container">
                    <canvas id="statusPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
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
                                    <span class="badge px-2.5 py-1.5 rounded-2 text-uppercase" style="font-size: 0.7rem; font-weight: 600;
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // 1. Line Trend Chart Initialization
    const trendCtx = document.getElementById('revenueTrendChart').getContext('2d');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Orders volume placed',
                data: [{{ $totalOrders * 0.2 }}, {{ $totalOrders * 0.4 }}, {{ $totalOrders * 0.3 }}, {{ $totalOrders * 0.6 }}, {{ $totalOrders * 0.8 }}, {{ $totalOrders }}],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.05)',
                fill: true,
                tension: 0.35,
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, grid: { borderDash: [5, 5] } }, x: { grid: { display: false } } }
        }
    });

    // 2. Status Summary Doughnut/Pie Chart Module Integration
    const pieCtx = document.getElementById('statusPieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Processing', 'Completed'],
            datasets: [{
                data: [{{ $pendingOrders }}, {{ $processingOrders }}, {{ max(0, $totalOrders - ($pendingOrders + $processingOrders)) }}],
                backgroundColor: ['#f59e0b', '#06b6d4', '#10b981'],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { family: 'Inter' } } } }
        }
    });
</script>
</body>
</html>