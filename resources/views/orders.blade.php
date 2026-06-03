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
        
        .main-content { 
            padding: 40px 0; 
            min-height: calc(100vh - 73px);
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

        .search-container {
            max-width: 320px;
            position: relative;
        }

        .search-container .fa-search {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 0.9rem;
            pointer-events: none;
        }

        .search-input {
            padding-left: 38px !important;
            border-radius: 10px !important;
            font-size: 0.9rem;
            border: 1px solid #cbd5e1;
            transition: all 0.2s ease;
        }

        .search-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            outline: none;
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
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 py-3 sticky-top shadow-sm">
    <div class="container">
        <span class="navbar-brand fw-bold text-dark m-0">
            <i class="fas fa-gem me-2" style="color: #4f46e5;"></i>Jewelry Shop Management
        </span>
        <div class="d-flex align-items-center gap-3">
            <a href="/dashboard" class="btn btn-link text-decoration-none text-secondary fw-medium p-0" style="font-size: 0.95rem;">Dashboard</a>
            <span class="text-muted">|</span>
            <a href="/orders" class="btn btn-link text-decoration-none text-indigo fw-bold p-0" style="font-size: 0.95rem; color: #4f46e5;">Orders</a>
            <span class="text-muted">|</span>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none text-danger fw-medium p-0" style="font-size: 0.95rem;">
                    <i class="fas fa-sign-out-alt me-1"></i>Sign Out
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container main-content">
    
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
                <div class="card-header bg-white py-4 px-4 border-bottom-0 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <h5 class="m-0 fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="fas fa-file-invoice-dollar text-muted" style="font-size: 1.1rem;"></i>Master Orders Console
                    </h5>
                    
                    <div class="d-flex align-items-center flex-wrap gap-2 ms-auto w-100 justify-content-md-end" style="max-width: 600px;">
                        <div class="search-container w-100">
                            <i class="fas fa-search"></i>
                            <input type="text" id="orderSearchInput" class="form-control search-input" placeholder="Search customer name or item..." onkeyup="filterOrdersTable()">
                        </div>
                        <span class="badge bg-light text-secondary border px-2.5 py-2 fw-semibold" style="font-size: 0.75rem; white-space: nowrap;">
                            {{ count($orders) }} Active Records
                        </span>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle" id="ordersMasterTable">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4 py-3">Customer Full Name</th>
                                    <th class="py-3">Jewelry Item</th>
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
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle text-center me-2.5" style="background-color: #f1f5f9; color: #64748b; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 600;">
                                                    {{ strtoupper(substr($order->customer_name ?? 'C', 0, 1)) }}
                                                </div>
                                                <span class="text-dark fw-bold customer-name-cell" style="font-size: 0.88rem;">
                                                    {{ $order->customer_name ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-secondary fw-semibold item-name-cell" style="font-size: 0.88rem;">
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
                                    <tr id="noOrdersRow">
                                        <td colspan="8" class="text-center py-5 text-muted">
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

    /**
     * Frontend Table Search Handler engine
     * Loops table records dynamically to look up values instantly without page reloads
     */
    function filterOrdersTable() {
        const input = document.getElementById('orderSearchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('ordersMasterTable');
        const tr = table.getElementsByTagName('tr');
        let totalVisible = 0;

        for (let i = 1; i < tr.length; i++) {
            // Ignore the "No orders found" fallback message row
            if (tr[i].id === 'noOrdersRow') continue;

            const nameCell = tr[i].getElementsByClassName('customer-name-cell')[0];
            const itemCell = tr[i].getElementsByClassName('item-name-cell')[0];
            
            if (nameCell || itemCell) {
                const nameText = nameCell ? nameCell.textContent || nameCell.innerText : "";
                const itemText = itemCell ? itemCell.textContent || itemCell.innerText : "";
                
                if (nameText.toLowerCase().indexOf(filter) > -1 || itemText.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    totalVisible++;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
</body>
</html>