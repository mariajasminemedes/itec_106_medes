<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order - Jewelry Order System</title>
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

        .input-group-text {
            background-color: #f8fafc;
            color: #64748b;
            border-right: none;
        }

        .input-group > .form-control, .input-group > .form-select {
            border-left: none;
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
            <a href="/orders" class="btn btn-link text-decoration-none text-secondary fw-medium p-0" style="font-size: 0.95rem;">Orders</a>
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
    
    <div class="mb-5 text-center text-sm-start">
        <h2 class="fw-bold tracking-tight mb-1" style="color: #0f172a;">Add New Order</h2>
        <p class="text-muted mb-0">Create and store a brand new custom jewelry order entry into the system pipeline.</p>
    </div>

    <div class="card border-0 mx-auto" style="max-width: 850px;">
        <div class="card-header bg-white py-4 px-4 border-bottom-0">
            <h5 class="m-0 fw-bold text-dark d-flex align-items-center">
                <i class="fas fa-pen-nib me-2 text-muted" style="font-size: 1.1rem;"></i>Order Details Form
            </h5>
        </div>
        
        <div class="card-body p-4 pt-0">
            
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
                
                <input type="hidden" id="customer_name" name="customer_name" value="{{ Auth::user()->name }}">
                
                <div class="mb-4">
                    <label class="form-label">Ordering Account Profile</label>
                    <div class="d-flex align-items-center bg-light border p-3 rounded-3" style="border-radius: 10px !important;">
                        <div class="rounded-circle text-center me-3" style="background-color: #e0e7ff; color: #4f46e5; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div>
                            <span class="d-block fw-bold text-dark" style="font-size: 0.95rem;">{{ Auth::user()->name }}</span>
                            <small class="text-muted small">This record will be stored automatically under your verified system login profile identity.</small>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="jewelry_item" class="form-label">Jewelry Item Classification</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-crown small"></i></span>
                        <select class="form-select" id="jewelry_item" name="jewelry_item" onchange="updateAutomaticPrice()" required>
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
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="{{ old('quantity', 1) }}" oninput="calculateGrossTotal()" required style="border-radius: 10px !important;">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="price" class="form-label">Unit Price (₱)</label>
                        <div class="input-group">
                            <span class="input-group-text fw-semibold" style="border-right: 1px solid #cbd5e1; border-top-right-radius: 0; border-bottom-right-radius: 0;">₱</span>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price', request('price')) }}" placeholder="0.00" readonly required style="border-left: 1px solid #cbd5e1; border-top-left-radius: 0; border-bottom-left-radius: 0; padding-left: 12px;">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="total_gross" class="form-label">Total Gross Cost</label>
                        <div class="input-group">
                            <span class="input-group-text fw-semibold" style="border-right: 1px solid #cbd5e1; border-top-right-radius: 0; border-bottom-right-radius: 0;">₱</span>
                            <input type="text" class="form-control" id="total_gross" readonly placeholder="0.00" style="border-left: 1px solid #cbd5e1; border-top-left-radius: 0; border-bottom-left-radius: 0; padding-left: 12px;">
                        </div>
                    </div>
                </div>
                
                <div class="mb-5">
                    <label for="status" class="form-label">Initial System Status</label>
                    <select class="form-select" id="status" name="status" required style="border-radius: 10px !important;">
                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Processing" {{ old('status') == 'Processing' ? 'selected' : '' }}>Processing</option>
                        <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                
                <div class="pt-4 border-top d-flex flex-wrap gap-2 justify-content-end">
                    <a href="/orders" class="btn btn-light px-4 py-2.5 rounded-3 border text-secondary fw-medium" style="border-radius: 8px;">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary px-4 py-2.5 rounded-3 fw-medium shadow-sm" style="background-color: #4f46e5; border-color: #4f46e5; border-radius: 8px;">
                        <i class="fas fa-save me-2"></i>Save Order Record
                    </button>
                </div>
            </form>
        </div>
    </div>
    
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // System Pricing Catalog configuration matching the dashboard stock options
    const priceCatalog = {
        "Ring": 45000.00,
        "Necklace": 62000.00,
        "Bracelet": 15500.00,
        "Earrings": 28000.00
    };

    /**
     * Automatically changes the unit price field based on dropdown changes
     */
    function updateAutomaticPrice() {
        const selectedItem = document.getElementById('jewelry_item').value;
        const priceInput = document.getElementById('price');
        
        if (selectedItem && priceCatalog[selectedItem]) {
            priceInput.value = priceCatalog[selectedItem].toFixed(2);
        } else if (!selectedItem) {
            priceInput.value = "";
        }
        
        calculateGrossTotal();
    }

    /**
     * Multiplies Unit Price by Quantity automatically
     */
    function calculateGrossTotal() {
        const unitPrice = parseFloat(document.getElementById('price').value) || 0;
        const quantity = parseInt(document.getElementById('quantity').value) || 1;
        const totalGrossDisplay = document.getElementById('total_gross');
        
        const dynamicTotal = unitPrice * quantity;
        totalGrossDisplay.value = dynamicTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    // Initialize calculations right away when the template is rendered
    window.addEventListener('DOMContentLoaded', () => {
        if(document.getElementById('jewelry_item').value) {
            // If loaded with URL parameters, instantly execute structural values
            calculateGrossTotal();
        }
    });
</script>
</body>
</html>