<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order - Jewelry Order System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Fixed Sidebar Layout Matching System theme */
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

        /* Main Workspace Adjustment */
        .main-content { margin-left: 260px; padding: 40px; }
        
        /* Modern Cards and Forms design structure */
        .card { border: none; border-radius: 12px; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.05); }
        .form-label { font-weight: 600; color: #4e73df; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-control, .form-select { border-radius: 8px; padding: 10px 15px; border: 1px solid #d1d3e2; transition: all 0.2s; }
        .form-control:focus, .form-select:focus { border-color: #4e73df; box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15); }
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
            <a class="nav-link" href="/orders"><i class="fas fa-fw fa-shopping-cart me-2"></i> Orders</a>
            <a class="nav-link active" href="/orders/create"><i class="fas fa-fw fa-plus-circle me-2"></i> Add Order</a>
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
        
        <div class="mb-4">
            <h3 class="text-gray-800 font-weight-bold mb-0">Add New Order</h3>
            <p class="text-muted small mb-0">Create and store a brand new custom jewelry order entry into the system.</p>
        </div>

        <div class="card" style="max-width: 800px;">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-pen-nib me-2 text-secondary"></i>Order Details Form</h6>
            </div>
            
            <div class="card-body p-4">
                
                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm rounded-3">
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
                    
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Customer Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-user small"></i></span>
                            <input type="text" class="form-control border-start-0" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" placeholder="Enter customer name" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="jewelry_item" class="form-label">Jewelry Item Classification</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-crown small"></i></span>
                            <select class="form-select border-start-0" id="jewelry_item" name="jewelry_item" onchange="updateAutomaticPrice()" required>
                                <option value="">Select an item category</option>
                                <option value="Ring" {{ (old('jewelry_item', request('item')) == 'Ring') ? 'selected' : '' }}>Ring</option>
                                <option value="Necklace" {{ (old('jewelry_item', request('item')) == 'Necklace') ? 'selected' : '' }}>Necklace</option>
                                <option value="Bracelet" {{ (old('jewelry_item', request('item')) == 'Bracelet') ? 'selected' : '' }}>Bracelet</option>
                                <option value="Earrings" {{ (old('jewelry_item', request('item')) == 'Earrings') ? 'selected' : '' }}>Earrings</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="quantity" class="form-label">Quantity (pcs)</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="{{ old('quantity', 1) }}" oninput="calculateGrossTotal()" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="price" class="form-label">Unit Price (₱)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary font-weight-bold">₱</span>
                                <input type="number" class="form-control bg-light" id="price" name="price" step="0.01" value="{{ old('price', request('price')) }}" placeholder="0.00" readonly required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="total_gross" class="form-label">Total Gross Cost</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary font-weight-bold">₱</span>
                                <input type="text" class="form-control bg-light" id="total_gross" readonly placeholder="0.00">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="status" class="form-label">Initial System Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Processing" {{ old('status') == 'Processing' ? 'selected' : '' }}>Processing</option>
                            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    
                    <div class="pt-2 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fas fa-save me-2"></i>Save Order Record
                        </button>
                        <a href="/orders" class="btn btn-light px-4 border text-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
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