<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Jewelry Order System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Fixed Sidebar Layout Structure */
        .sidebar { 
            position: fixed; 
            top: 0; 
            left: 0; 
            bottom: 0; 
            width: 260px; 
            background: linear-gradient(180deg, #4e73df 0%, #224abe 100%); 
            z-index: 100;
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
        }
        .sidebar .nav-link { 
            color: rgba(255,255,255,0.75); 
            padding: 12px 20px; 
            margin: 4px 15px; 
            border-radius: 8px; 
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .sidebar .nav-link:hover { 
            background-color: rgba(255,255,255,0.1); 
            color: #ffffff; 
        }
        .sidebar .nav-link.active { 
            background-color: rgba(255,255,255,0.2); 
            color: #ffffff; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Main Content Shifted Right to Clear Sidebar */
        .main-content { margin-left: 260px; padding: 40px; }
        
        /* Modern Design Component Simplifications */
        .card { border: none; border-radius: 12px; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.05); }
        .stat-card { position: relative; overflow: hidden; border-left: 5px solid; transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-3px); }
        .stat-card .icon-bg { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); font-size: 2.5rem; opacity: 0.15; }
        .table th { font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; color: #5a5c69; }
    </style>
</head>
<body>

    <div class="sidebar d-flex flex-column p-0">
        <div class="text-white p-4 border-bottom border-white-50 border-opacity-10">
            <h5 class="mb-0 font-weight-bold"><i class="fas fa-gem me-2"></i>Jewelry Shop</h5>
            <small class="text-white-50">Management Dashboard</small>
        </div>
        
        <nav class="nav flex-column mt-3 flex-grow-1">
            <a class="nav-link active" href="/dashboard"><i class="fas fa-fw fa-home me-2"></i> Dashboard</a>
            <a class="nav-link" href="/orders"><i class="fas fa-fw fa-shopping-cart me-2"></i> Orders</a>
            <a class="nav-link" href="/orders/create"><i class="fas fa-fw fa-plus-circle me-2"></i> Add Order</a>
            <a class="nav-link" href="/profile"><i class="fas fa-fw fa-user me-2"></i> My Profile</a>
        </nav>

        <div class="p-3 border-top border-white-50 border-opacity-10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100 py-2 border-0 opacity-75 hover-opacity-100 text-start px-3">
                    <i class="fas fa-sign-out-alt me-2"></i> Sign Out
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="text-gray-800 font-weight-bold mb-0">Overview Dashboard</h3>
                <p class="text-muted small mb-0">Welcome back, <strong>{{ Auth::user()->username }}</strong>! Ready to manage your jewelry assets.</p>
            </div>
            <a href="/orders/create" class="btn btn-primary px-4 shadow-sm">
                <i class="fas fa-plus me-2"></i>Place New Order
            </a>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card stat-card bg-white p-4" style="border-left-color: #4e73df;">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Orders Tracked</div>
                    <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }}</div>
                    <i class="fas fa-boxes icon-bg text-primary"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card bg-white p-4" style="border-left-color: #f6c23e;">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Pending Shipments</div>
                    <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $pendingOrders }}</div>
                    <i class="fas fa-clock icon-bg text-warning"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card bg-white p-4" style="border-left-color: #1cc88a;">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Orders Processing</div>
                    <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $processingOrders }}</div>
                    <i class="fas fa-spinner fa-spin icon-bg text-success"></i>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-list me-2 text-secondary"></i>Recent Purchases Inventory</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Jewelry Item Classification</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Current Status</th>
                                <th class="pe-4">Order Timestamp Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light p-2 rounded me-3 text-secondary">
                                                <i class="fas fa-crown"></i>
                                            </div>
                                            <strong>{{ $order->jewelry_item }}</strong>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border px-2 py-1">{{ $order->quantity }} pcs</span></td>
                                    <td><span class="text-dark font-weight-bold">₱{{ number_format($order->price, 2) }}</span></td>
                                    <td>
                                        <span class="badge px-3 py-2 rounded-pill 
                                            {{ $order->status == 'Pending' ? 'bg-warning text-dark' : '' }}
                                            {{ $order->status == 'Processing' ? 'bg-info text-white' : '' }}
                                            {{ $order->status == 'Completed' ? 'bg-success text-white' : '' }}
                                            {{ $order->status == 'Cancelled' ? 'bg-danger text-white' : '' }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="text-muted pe-4 small">{{ date('M d, Y • h:i A', strtotime($order->order_date)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <div class="mb-2"><i class="fas fa-folder-open fa-2x opacity-50"></i></div>
                                        <span>No dynamic system entries are saved to your profile history yet.</span>
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
</body>
</html><!DOCTYPE html>
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
            background-color: #f8fafc; 
            font-family: 'Inter', sans-serif;
            color: #334155;
        }
        
        /* Sidebar Restyling */
        .sidebar { 
            width: 260px; 
            background: #0f172a; 
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
        .sidebar .nav-link.active { font-weight: 600; }

        /* Card Adjustments */
        .card-custom { 
            border: none; 
            border-radius: 16px; 
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            background-color: #ffffff;
        }
        .stat-card { transition: transform 0.2s, box-shadow 0.2s; }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        /* Responsive Layout Grid Logic */
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
    <!-- Desktop Sidebar Frame Layout -->
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

    <!-- Mobile Screen Alternate Menu Navigation -->
    <nav class="navbar navbar-dark bg-dark d-lg-none px-3 sticky-top w-100">
        <span class="navbar-brand fw-bold"><i class="fas fa-gem me-2 text-info"></i>Jewelry Shop</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="offcanvas offcanvas-start bg-dark text-white d-lg-none" tabindex="-1" id="mobileSidebar" style="width: 280px;">
        <div class="offcanvas-header border-bottom border-secondary border-opacity-25">
            <h5 class="offcanvas-title fw-bold text-white"><i class="fas fa-gem me-2 text-info"></i>Jewelry Shop</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
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

    <!-- Primary Application Dashboard View Area -->
    <div class="main-content w-100">
        
        <!-- Upper Panel Header Title Section -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
            <div>
                <h3 class="fw-bold tracking-tight mb-1 text-dark">Overview Dashboard</h3>
                <p class="text-muted small mb-0">Welcome back, <span class="fw-semibold text-dark">{{ Auth::user()->username ?? 'Operator' }}</span>! Ready to manage your jewelry assets.</p>
            </div>
            <a href="/orders/create" class="btn btn-dark px-4 rounded-pill shadow-sm w-100 w-sm-auto">
                <i class="fas fa-plus me-2 small"></i>Place New Order
            </a>
        </div>

        <!-- Metric Statistical Cards Grid Panel -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <div class="card card-custom stat-card p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase text-muted fw-semibold mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Total Orders Tracked</div>
                            <div class="h2 mb-0 fw-bold text-slate-800">{{ $totalOrders ?? 0 }}</div>
                        </div>
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                            <i class="fas fa-boxes fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card card-custom stat-card p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase text-muted fw-semibold mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Pending Shipments</div>
                            <div class="h2 mb-0 fw-bold text-slate-800">{{ $pendingOrders ?? 0 }}</div>
                        </div>
                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                            <i class="fas fa-clock fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card card-custom stat-card p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase text-muted fw-semibold mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Orders Processing</div>
                            <div class="h2 mb-0 fw-bold text-slate-800">{{ $processingOrders ?? 0 }}</div>
                        </div>
                        <div class="bg-info bg-opacity-10 text-info rounded-3 p-3">
                            <i class="fas fa-spinner fa-spin fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Simple Feature: Real-Time Business Analysis Charts -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-lg-7">
                <div class="card card-custom p-4 h-100">
                    <div class="mb-3">
                        <h6 class="m-0 fw-bold text-dark"><i class="fa-solid fa-chart-bar me-2 text-muted"></i>Order Quantity Patterns</h6>
                        <p class="small text-muted mb-0">Visual summary tracking stock variations across purchases.</p>
                    </div>
                    <div style="position: relative; height: 260px;">
                        <canvas id="quantityBarChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="card card-custom p-4 h-100">
                    <div class="mb-3">
                        <h6 class="m-0 fw-bold text-dark"><i class="fa-solid fa-chart-pie me-2 text-muted"></i>Status Distribution</h6>
                        <p class="small text-muted mb-0">Proportional check on existing workflow states.</p>
                    </div>
                    <div style="position: relative; height: 260px;" class="d-flex justify-content-center">
                        <canvas id="statusDoughnutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Registry Center Card Shell -->
        <div class="card card-custom">
            
            <!-- Simple Feature: Search Filter Interaction Controller Panel Bar -->
            <div class="card-header bg-white py-3 border-bottom d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-list me-2 text-muted"></i>Recent Purchases Inventory</h6>
                <div class="d-flex align-items-center gap-2 w-100 w-md-auto">
                    <div class="input-group input-group-sm" style="max-width: 260px;">
                        <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" id="inventorySearch" class="form-control bg-light border-start-0" placeholder="Search item...">
                    </div>
                    <select id="statusFilter" class="form-select form-select-sm bg-light" style="width: 130px;">
                        <option value="ALL">All Statuses</option>
                        <option value="PENDING">Pending</option>
                        <option value="PROCESSING">Processing</option>
                        <option value="COMPLETED">Completed</option>
                        <option value="CANCELLED">Cancelled</option>
                    </select>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle" id="inventoryTable">
                        <thead class="table-light text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">
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
                                <tr class="inventory-row" data-item="{{ strtolower($order->jewelry_item) }}" data-status="{{ strtoupper($order->status) }}">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light p-2 rounded-3 me-3 text-secondary border">
                                                <i class="fas fa-crown"></i>
                                            </div>
                                            <span class="fw-semibold text-dark">{{ $order->jewelry_item }}</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-secondary border px-2 py-1 fw-medium">{{ $order->quantity }} pcs</span></td>
                                    <td><span class="text-dark fw-semibold">₱{{ number_format($order->price, 2) }}</span></td>
                                    <td>
                                        <span class="badge px-2.5 py-1.5 rounded-2 text-uppercase" style="font-size: 0.68rem; font-weight: 600;
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
                                <tr id="emptyRowPlaceholder">
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
<!-- Include Chart.js via CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // 1. Chart.js Matrix Configurations
        // Extract metrics parameters carefully or fall back onto base arrays safely
        const chartLabels = {!! json_encode($orders->take(6)->pluck('jewelry_item') ?? []) !!};
        const chartQuantities = {!! json_encode($orders->take(6)->pluck('quantity') ?? []) !!};
        
        // Bar Chart - Quantity tracking configuration
        const barCtx = document.getElementById('quantityBarChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: chartLabels.length ? chartLabels : ['No Data'],
                datasets: [{
                    label: 'Items Ordered',
                    data: chartQuantities.length ? chartQuantities : [0],
                    backgroundColor: '#3b82f6',
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#f1f5f9' }, ticks: { color: '#94a3b8' } },
                    x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                }
            }
        });

        // Doughnut Chart - Status distributions matching metric numbers
        const doughnutCtx = document.getElementById('statusDoughnutChart').getContext('2d');
        new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Processing', 'Completed'],
                datasets: [{
                    data: [{{ $pendingOrders ?? 0 }}, {{ $processingOrders ?? 0 }}, {{ ($totalOrders ?? 0) - (($pendingOrders ?? 0) + ($processingOrders ?? 0)) }}],
                    backgroundColor: ['#f59e0b', '#06b6d4', '#10b981'],
                    borderWidth: 4,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { family: 'Inter' } } } },
                cutout: '75%'
            }
        });

        // 2. Simple Feature: Real-time Client-Side Search and Status Filter logic
        const searchInput = document.getElementById('inventorySearch');
        const statusFilter = document.getElementById('statusFilter');
        const rows = document.querySelectorAll('.inventory-row');

        function filterTable() {
            const query = searchInput.value.toLowerCase().trim();
            const selectedStatus = statusFilter.value;
            let visibleCount = 0;

            rows.forEach(row => {
                const itemAttr = row.getAttribute('data-item');
                const statusAttr = row.getAttribute('data-status');
                
                const matchesSearch = itemAttr.includes(query);
                const matchesStatus = (selectedStatus === 'ALL') || (statusAttr === selectedStatus);

                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
        }

        if(searchInput && statusFilter) {
            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
        }
    });
</script>
</body>
</html>