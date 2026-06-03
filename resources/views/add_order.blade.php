<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management - Jewelry System</title>
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
            padding: 40px; 
            min-height: 100vh;
        }

        .card { 
            background: #ffffff;
            border: 1px solid #e2e8f0; 
            border-radius: 16px; 
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
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
            transition: all 0.2s ease; 
        }

        .form-control:focus, .form-select:focus { 
            border-color: #4f46e5; 
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); 
            color: #0f172a;
        }

        .form-control:read-only {
            background-color: #f8fafc;
            color: #64748b;
            border-color: #cbd5e1 !important;
        }

        .table th {
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 py-3 sticky-top shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold text-dark m-0">
            <i class="fas fa-gem me-2" style="color: #4f46e5;"></i>Jewelry Shop Management
        </span>
        <div class="d-flex align-items-center gap-3">
            <a href="/dashboard" class="btn btn-link text-decoration-none text-secondary fw-medium p-0">Dashboard</a>
            <span class="text-muted">|</span>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none text-danger fw-medium p-0">
                    <i class="fas fa-sign-out-alt me-1"></i>Sign Out
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Main Container Context -->
<div class="container main-content">
    
    <!-- Top Dashboard Context Control Panel Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-5 gap-3">
        <div>
            <h2 class="fw-bold tracking-tight mb-1" style="color: #0f172a;">Orders Pipeline</h2>
            <p class="text-muted mb-0">Track, manage, and monitor all jewelry transactions and fabrication records.</p>
        </div>
        <div>
            <!-- Trigger button to pop open the modal framework component -->
            <button type="button" class="btn btn-primary px-4 py-2.5 rounded-3 fw-medium shadow-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addOrderModal" style="background-color: #4f46e5; border-color: #4f46e5;">
                <i class="fas fa-plus-circle me-2"></i>Add New Order
            </button>
        </div>
    </div>

    <!-- Data Collection Table Summary View -->
    <div class="card shadow-sm border-0 w-100 mb-5">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3 py-3">Customer</th>
                            <th class="py-3">Classification</th>
                            <th class="py-3 text-center">Qty</th>
                            <th class="py-3 text-end">Unit Price</th>
                            <th class="py-3 text-end">Gross Cost</th>
                            <th class="py-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders ?? [] as $order)
                            <tr>
                                <td class="ps-3 fw-semibold text-dark">{{ $order->customer_name }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1.5" style="font-size: 0.85rem;">
                                        <i class="fas fa-crown me-1 text-muted"></i> {{ $order->jewelry_item }}
                                    </span>
                                </td>
                                <td class="text-center fw-medium">{{ $order->quantity }}</td>
                                <td class="text-end fw-medium">₱{{ number_format($order->price, 2) }}</td>
                                <td class="text-end fw-bold text-dark">₱{{ number_format($order->price * $order->quantity, 2) }}</td>
                                <td class="text-center">
                                    <span class="badge px-3 py-2 rounded-pill 
                                        @if($order->status == 'Pending') bg-warning text-dark 
                                        @elseif($order->status == 'Processing') bg-info text-dark 
                                        @elseif($order->status == 'Completed') bg-success text-white 
                                        @else bg-secondary text-white @endif" style="font-size: 0.8rem;">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-3 d-block text-light"></i>
                                    No orders found in the pipeline database. Click "Add New Order" to create one.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ==================== ADD ORDER MODAL COMPONENT ==================== -->
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
            
            <div class="modal-header bg-white py-4 px-4 border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center" id="addOrderModalLabel">
                    <i class="fas fa-pen-nib me-2 text-muted" style="font-size: 1.1rem;"></i>Order Details Form
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4 pt-2">
                <p class="text-muted small mb-4">Create and store a brand new custom jewelry order entry into the system pipeline.</p>
                
                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm rounded-3 p-3 mb-4" style="background-color: #fee2e2; color: #991b1b;">
                        <div class="d-flex align-items-center mb-2 fw-bold">
                            <i class="fas fa-exclamation-circle me-2"></i> Please correct the fields below:
                        </div>
                        <ul class="mb-0 ps-4 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="customer_name" class="form-label">Customer Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 10px 0 0 10px;"><i class="fas fa-user small"></i></span>
                            <input type="text" class="form-control border-start-0" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" placeholder="Enter customer name" required style="border-radius: 0 10px 10px 0;">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="jewelry_item" class="form-label">Jewelry Item Classification</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 10px 0 0 10px;"><i class="fas fa-crown small"></i></span>
                            <select class="form-select border-start-0" id="jewelry_item" name="jewelry_item" onchange="modalUpdateAutomaticPrice()" required style="border-radius: 0 10px 10px 0;">
                                <option value="">Select an item category</option>
                                <option value="Ring" {{ (old('jewelry_item', request('item')) == 'Ring') ? 'selected' : '' }}>Ring</option>
                                <option value="Necklace" {{ (old('jewelry_item', request('item')) == 'Necklace') ? 'selected' : '' }}>Necklace</option>
                                <option value="Bracelet" {{ (old('jewelry_item', request('item')) == 'Bracelet') ? 'selected' : '' }}>Bracelet</option>
                                <option value="Earrings" {{ (old('jewelry_item', request('item')) == 'Earrings') ? 'selected' : '' }}>Earrings</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-md-4">
                            <label for="quantity" class="form-label">Quantity (pcs)</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="{{ old('quantity', 1) }}" oninput="modalCalculateGrossTotal()" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="price" class="form-label">Unit Price (₱)</label>
                            <div class="input-group">
                                <span class="input-group-text fw-semibold bg-light text-muted" style="border-radius: 10px 0 0 10px; border-right: 1px solid #cbd5e1;">₱</span>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price', request('price')) }}" placeholder="0.00" readonly required style="border-radius: 0 10px 10px 0; border-left: 1px solid #cbd5e1;">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="total_gross" class="form-label">Total Gross Cost</label>
                            <div class="input-group">
                                <span class="input-group-text fw-semibold bg-light text-muted" style="border-radius: 10px 0 0 10px; border-right: 1px solid #cbd5e1;">₱</span>
                                <input type="text" class="form-control" id="total_gross" readonly placeholder="0.00" style="border-radius: 0 10px 10px 0; border-left: 1px solid #cbd5e1;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-5">
                        <label for="status" class="form-label">Initial System Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Processing" {{ old('status') == 'Processing' ? 'selected' : '' }}>Processing</option>
                            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    
                    <div class="pt-4 border-top d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light px-4 py-2.5 border text-secondary fw-medium" data-bs-dismiss="modal" style="border-radius: 8px;">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary px-4 py-2.5 fw-medium shadow-sm" style="background-color: #4f46e5; border-color: #4f46e5; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Save Order Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // System Pricing Catalog configuration matching the dashboard stock options
    const modalPriceCatalog = {
        "Ring": 45000.00,
        "Necklace": 62000.00,
        "Bracelet": 15500.00,
        "Earrings": 28000.00
    };

    /**
     * Automatically changes the unit price field based on dropdown changes
     */
    function modalUpdateAutomaticPrice() {
        const selectedItem = document.getElementById('jewelry_item').value;
        const priceInput = document.getElementById('price');
        
        if (selectedItem && modalPriceCatalog[selectedItem]) {
            priceInput.value = modalPriceCatalog[selectedItem].toFixed(2);
        } else if (!selectedItem) {
            priceInput.value = "";
        }
        
        modalCalculateGrossTotal();
    }

    /**
     * Multiplies Unit Price by Quantity automatically
     */
    function modalCalculateGrossTotal() {
        const unitPrice = parseFloat(document.getElementById('price').value) || 0;
        const quantity = parseInt(document.getElementById('quantity').value) || 1;
        const totalGrossDisplay = document.getElementById('total_gross');
        
        const dynamicTotal = unitPrice * quantity;
        totalGrossDisplay.value = dynamicTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    // Auto-calculate on initial load if field comes pre-filled via parameters
    document.addEventListener('DOMContentLoaded', () => {
        if(document.getElementById('jewelry_item') && document.getElementById('jewelry_item').value) {
            modalCalculateGrossTotal();
        }
    });

    // Keeping the modal open automatically if validation fails on form processing
    @if($errors->any())
        $(document).ready(function() {
            var myModal = new bootstrap.Modal(document.getElementById('addOrderModal'));
            myModal.show();
        });
    @endif
</script>
</body>
</html>