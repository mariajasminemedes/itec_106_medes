<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Jewelry Order System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Fixed Sidebar Layout Matching Dashboard */
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

        /* Main Content Alignment */
        .main-content { margin-left: 260px; padding: 40px; }
        
        /* Card & Table Cleanups */
        .card { border: none; border-radius: 12px; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.05); overflow: hidden; }
        .table th { font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; color: #5a5c69; padding-top: 15px; padding-bottom: 15px; }
        .table td { padding-top: 15px; padding-bottom: 15px; }
        
        /* Action buttons layout */
        .action-btn { width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; transition: all 0.2s; }
        
        /* Item Catalog Display Designs */
        .item-card { transition: transform 0.2s, box-shadow 0.2s; border: 1px solid #e3e6f0; }
        .item-card:hover { transform: translateY(-3px); box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .item-img-wrapper { height: 140px; overflow: hidden; position: relative; background-color: #eaecf4; }
        .item-img { width: 100%; height: 100%; object-fit: cover; }
        .item-category { position: absolute; top: 10px; left: 10px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
    </style>
</head>
<body>

    <div class="sidebar d-flex flex-column p-0">
        <div class="text-white p-4 border-bottom border-white-50 border-opacity-10">
            <h5 class="mb-0 font-weight-bold"><i class="fas fa-gem me-2"></i>Jewelry Shop</h5>
            <small class="text-white-50">Management Dashboard</small>
        </div>
        
        <nav class="nav flex-column mt-3 flex-grow-1">
            <a class="nav-link" href="/dashboard"><i class="fas fa-fw fa-home me-2"></i> Dashboard</a>
            <a class="nav-link active" href="/orders"><i class="fas fa-fw fa-shopping-cart me-2"></i> Orders</a>
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
                <h3 class="text-gray-800 font-weight-bold mb-0">Manage Orders &amp; Catalog</h3>
                <p class="text-muted small mb-0">View stock item options alongside active customer transaction ledgers.</p>
            </div>
            <a href="/orders/create" class="btn btn-primary px-4 shadow-sm">
                <i class="fas fa-plus me-2"></i>Add New Order
            </a>
        </div>

        <div class="row g-4">
            
            <div class="col-xl-4 col-lg-12">
                <div class="card mb-4">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-boxes text-secondary me-2"></i>Available Stock Options</h6>
                        <span class="badge bg-primary rounded-pill">4 Items</span>
                    </div>
                    <div class="card-body p-3 bg-light-subtle">
                        <div class="row g-3">
                            
                            <div class="col-md-6 col-xl-12">
                                <div class="card item-card h-100">
                                    <div class="item-img-wrapper">
                                        <span class="badge bg-dark item-category">Ring</span>
                                        <img src="https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=400&q=80" class="item-img" alt="Luxury Ring">
                                    </div>
                                    <div class="card-body p-3 d-flex flex-column">
                                        <h6 class="font-weight-bold text-dark mb-1">Classic Diamond Ring</h6>
                                        <p class="text-muted small mb-3 text-truncate-2" style="font-size: 0.8rem; line-height: 1.4;">18k white gold band set with a brilliant-cut center diamond stone.</p>
                                        <div class="mt-auto d-flex align-items-center justify-content-between">
                                            <span class="fw-bold text-primary">₱45,000.00</span>
                                            <button type="button" onclick="selectCatalogItem('Ring', 45000)" class="btn btn-xs btn-primary px-2 py-1 rounded" style="font-size: 0.75rem;">
                                                <i class="fas fa-cart-plus me-1"></i>Select
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-12">
                                <div class="card item-card h-100">
                                    <div class="item-img-wrapper">
                                        <span class="badge bg-dark item-category">Necklace</span>
                                        <img src="https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=400&q=80" class="item-img" alt="Gold Chain">
                                    </div>
                                    <div class="card-body p-3 d-flex flex-column">
                                        <h6 class="font-weight-bold text-dark mb-1">Premium Gold Chain</h6>
                                        <p class="text-muted small mb-3 text-truncate-2" style="font-size: 0.8rem; line-height: 1.4;">Solid 24k gold interlocking chain mesh meticulously hand-polished.</p>
                                        <div class="mt-auto d-flex align-items-center justify-content-between">
                                            <span class="fw-bold text-primary">₱62,000.00</span>
                                            <button type="button" onclick="selectCatalogItem('Necklace', 62000)" class="btn btn-xs btn-primary px-2 py-1 rounded" style="font-size: 0.75rem;">
                                                <i class="fas fa-cart-plus me-1"></i>Select
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-12">
                                <div class="card item-card h-100">
                                    <div class="item-img-wrapper">
                                        <span class="badge bg-dark item-category">Bracelet</span>
                                        <img src="https://images.unsplash.com/photo-1611591437281-460bfbe1220a?w=400&q=80" class="item-img" alt="Silver Bangle">
                                    </div>
                                    <div class="card-body p-3 d-flex flex-column">
                                        <h6 class="font-weight-bold text-dark mb-1">Silver Charm Bangle</h6>
                                        <p class="text-muted small mb-3 text-truncate-2" style="font-size: 0.8rem; line-height: 1.4;">Elegant Sterling 925 silver bracelet with adjustable custom layout anchors.</p>
                                        <div class="mt-auto d-flex align-items-center justify-content-between">
                                            <span class="fw-bold text-primary">₱15,500.00</span>
                                            <button type="button" onclick="selectCatalogItem('Bracelet', 15500)" class="btn btn-xs btn-primary px-2 py-1 rounded" style="font-size: 0.75rem;">
                                                <i class="fas fa-cart-plus me-1"></i>Select
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-12">
                                <div class="card item-card h-100">
                                    <div class="item-img-wrapper">
                                        <span class="badge bg-dark item-category">Earrings</span>
                                        <img src="https://images.unsplash.com/photo-1635767798638-3e25273a8236?w=400&q=80" class="item-img" alt="Crystal Drops">
                                    </div>
                                    <div class="card-body p-3 d-flex flex-column">
                                        <h6 class="font-weight-bold text-dark mb-1">Crystal Drop Studs</h6>
                                        <p class="text-muted small mb-3 text-truncate-2" style="font-size: 0.8rem; line-height: 1.4;">Exquisite sapphire chandelier drops optimized for premium gala statement aesthetics.</p>
                                        <div class="mt-auto d-flex align-items-center justify-content-between">
                                            <span class="fw-bold text-primary">₱28,000.00</span>
                                            <button type="button" onclick="selectCatalogItem('Earrings', 28000)" class="btn btn-xs btn-primary px-2 py-1 rounded" style="font-size: 0.75rem;">
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

            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-table me-2 text-secondary"></i>Orders Ledger Directory</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Customer Name</th>
                                        <th>Jewelry Item</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total Gross</th>
                                        <th>Status</th>
                                        <th>Order Date</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light p-2 rounded-circle me-2 text-primary text-center" style="width: 35px; height: 35px;">
                                                        <i class="fas fa-user-tie small"></i>
                                                    </div>
                                                    <strong>{{ $order->customer_name }}</strong>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-dark font-weight-bold"><i class="fas fa-crown text-muted me-1 small"></i>{{ $order->jewelry_item }}</span>
                                            </td>
                                            <td><span class="badge bg-light text-dark border px-2 py-1">{{ $order->quantity }} pcs</span></td>
                                            <td class="text-secondary">₱{{ number_format($order->price, 2) }}</td>
                                            <td class="text-dark font-weight-bold">₱{{ number_format($order->total_price, 2) }}</td>
                                            <td>
                                                <span class="badge px-3 py-2 rounded-pill 
                                                    {{ $order->status == 'Pending' ? 'bg-warning text-dark' : '' }}
                                                    {{ $order->status == 'Processing' ? 'bg-info text-white' : '' }}
                                                    {{ $order->status == 'Completed' ? 'bg-success text-white' : '' }}
                                                    {{ $order->status == 'Cancelled' ? 'bg-danger text-white' : '' }}">
                                                    {{ $order->status }}
                                                </span>
                                            </td>
                                            <td class="text-muted small">{{ date('M d, Y • h:i A', strtotime($order->order_date)) }}</td>
                                            <td class="text-end pe-4">
                                                <a href="/orders/{{ $order->id }}/edit" class="btn btn-outline-primary action-btn me-1" title="Edit Order">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <form action="/orders/{{ $order->id }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger action-btn" title="Delete Order">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-5 text-muted">
                                                <div class="mb-3"><i class="fas fa-inbox fa-3x opacity-40"></i></div>
                                                <h5>No orders found</h5>
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

        </div> </div>

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