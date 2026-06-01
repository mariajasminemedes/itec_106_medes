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
</html>