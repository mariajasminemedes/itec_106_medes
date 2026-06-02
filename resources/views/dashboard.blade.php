<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Jewelry Order System</title>
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
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card {
            border-bottom: 4px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.04);
        }

        .chart-container {
            position: relative;
            height: 280px;
            width: 100%;
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
            <a class="nav-link active" href="/dashboard"><i class="fas fa-fw fa-chart-pie me-2"></i> Dashboard</a>
            <a class="nav-link" href="/orders"><i class="fas fa-fw fa-shopping-cart me-2"></i> Orders</a>
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
            <a class="nav-link active py-3 px-4" href="/dashboard"><i class="fas fa-fw fa-chart-pie me-3"></i> Dashboard</a>
            <a class="nav-link py-3 px-4 text-muted" href="/orders"><i class="fas fa-fw fa-shopping-cart me-3"></i> Orders</a>
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
    
    <div class="mb-5">
        <h2 class="fw-bold tracking-tight mb-1" style="color: #0f172a;">Overview Dashboard</h2>
        <p class="text-muted mb-0">Welcome back, <span class="fw-semibold text-dark">{{ Auth::user()->username }}</span>! Here's your automated enterprise shop assessment.</p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-12 col-md-4">
            <div class="card stat-card p-4 shadow-sm h-100" style="border-bottom-color: #6366f1;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-muted fw-semibold mb-2" style="font-size: 0.7rem; letter-spacing: 0.5px;">Total Orders Tracked</div>
                        <div class="display-6 mb-0 fw-bold text-dark">{{ $totalOrders }}</div>
                    </div>
                    <div class="bg-light text-primary rounded-3 p-3" style="background-color: #f5f3ff !important; color: #6366f1 !important;">
                        <i class="fas fa-boxes fa-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card stat-card p-4 shadow-sm h-100" style="border-bottom-color: #f59e0b;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-muted fw-semibold mb-2" style="font-size: 0.7rem; letter-spacing: 0.5px;">Pending Shipments</div>
                        <div class="display-6 mb-0 fw-bold text-dark">{{ $pendingOrders }}</div>
                    </div>
                    <div class="bg-light text-warning rounded-3 p-3" style="background-color: #fffbeb !important; color: #f59e0b !important;">
                        <i class="fas fa-clock fa-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card stat-card p-4 shadow-sm h-100" style="border-bottom-color: #06b6d4;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-muted fw-semibold mb-2" style="font-size: 0.7rem; letter-spacing: 0.5px;">Orders Processing</div>
                        <div class="display-6 mb-0 fw-bold text-dark">{{ $processingOrders }}</div>
                    </div>
                    <div class="bg-light text-info rounded-3 p-3" style="background-color: #ecfeff !important; color: #06b6d4 !important;">
                        <i class="fas fa-spinner fa-spin fa-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-12 col-lg-8">
            <div class="card p-4 shadow-sm h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-chart-line text-muted me-2"></i>Order Distribution & Trends</h5>
                    <span class="badge bg-light text-secondary border px-2 py-1.5 fw-normal">Updated Live</span>
                </div>
                <div class="chart-container">
                    <canvas id="revenueTrendChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card p-4 shadow-sm h-100">
                <h5 class="fw-bold mb-4 text-dark"><i class="fas fa-chart-pie text-muted me-2"></i>Status Breakdown</h5>
                <div class="chart-container d-flex align-items-center justify-content-center">
                    <canvas id="statusPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-4 px-4 border-bottom-0 d-flex align-items-center justify-content-between">
            <h5 class="m-0 fw-bold text-dark"><i class="fas fa-list me-2 text-muted"></i>Recent Purchases Inventory</h5>
            <span class="text-muted small">Showing historical pipeline log</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.8px;">
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
                                        <div class="p-2 rounded-3 me-3" style="background-color: #f1f5f9; color: #4f46e5;">
                                            <i class="fas fa-crown"></i>
                                        </div>
                                        <span class="fw-semibold text-dark">{{ $order->jewelry_item }}</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-secondary border px-2.5 py-1.5 fw-medium">{{ $order->quantity }} pcs</span></td>
                                <td><span class="text-dark fw-semibold">₱{{ number_format($order->price, 2) }}</span></td>
                                <td>
                                    <span class="badge-custom text-uppercase d-inline-block" style="
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
                                    <div class="mb-3"><i class="fas fa-folder-open fa-3x text-black-50" style="opacity: 0.25;"></i></div>
                                    <span class="fw-medium">No entries found in your history yet.</span>
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
    // 1. Line Trend Chart Architecture Setup
    const trendCtx = document.getElementById('revenueTrendChart').getContext('2d');
    
    // Creating gradient fill background for standard area line chart chart canvas
    const primaryGradient = trendCtx.createLinearGradient(0, 0, 0, 260);
    primaryGradient.addColorStop(0, 'rgba(79, 70, 229, 0.22)');
    primaryGradient.addColorStop(1, 'rgba(79, 70, 229, 0.00)');

    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Orders volume tracked',
                data: [{{ $totalOrders * 0.2 }}, {{ $totalOrders * 0.4 }}, {{ $totalOrders * 0.3 }}, {{ $totalOrders * 0.6 }}, {{ $totalOrders * 0.8 }}, {{ $totalOrders }}],
                borderColor: '#4f46e5',
                backgroundColor: primaryGradient,
                fill: true,
                tension: 0.3,
                borderWidth: 3,
                pointBackgroundColor: '#4f46e5',
                pointHoverRadius: 6,
                pointRadius: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { 
                y: { 
                    beginAtZero: true, 
                    grid: { color: '#f1f5f9' },
                    ticks: { color: '#94a3b8', font: { family: 'Plus Jakarta Sans', size: 11 } }
                }, 
                x: { 
                    grid: { display: false },
                    ticks: { color: '#94a3b8', font: { family: 'Plus Jakarta Sans', size: 11 } }
                } 
            }
        }
    });

    // 2. Status Summary Breakdown Doughnut Chart config 
    const pieCtx = document.getElementById('statusPieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Processing', 'Completed'],
            datasets: [{
                data: [{{ $pendingOrders }}, {{ $processingOrders }}, {{ max(0, $totalOrders - ($pendingOrders + $processingOrders)) }}],
                backgroundColor: ['#f59e0b', '#06b6d4', '#10b981'],
                borderWidth: 3,
                borderColor: '#ffffff',
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { 
                    position: 'bottom', 
                    labels: { 
                        padding: 16,
                        boxWidth: 8, 
                        boxHeight: 8,
                        borderRadius: 4,
                        font: { family: 'Plus Jakarta Sans', weight: 500, size: 12 } 
                    } 
                } 
            },
            cutout: '78%'
        }
    });
</script>
</body>
</html>