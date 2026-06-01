<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order - Jewelry Order System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 p-0" style="min-height: 100vh; background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);">
                <div class="text-white p-4">
                    <h4 class="mb-0">💎 Jewelry Shop</h4>
                    <small>Order Management</small>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link text-white-50 px-4 py-3" href="/dashboard"><i class="fas fa-home me-2"></i> Dashboard</a>
                    <a class="nav-link text-white px-4 py-3 active" href="/orders" style="background-color: rgba(255,255,255,0.2);"><i class="fas fa-shopping-cart me-2"></i> Orders</a>
                    <a class="nav-link text-white-50 px-4 py-3" href="/orders/create"><i class="fas fa-plus-circle me-2"></i> Add Order</a>
                    <a class="nav-link text-white-50 px-4 py-3" href="/profile"><i class="fas fa-user me-2"></i> My Profile</a>
                </nav>
            </div>

            <div class="col-md-10 p-4">
                <h2 class="mb-4">Edit Order #{{ $order->id }}</h2>

                <div class="card border-0 shadow-sm" style="max-width: 800px;">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0"><i class="fas fa-edit me-2 text-warning"></i>Modify Order Details</h5>
                    </div>
                    <div class="card-body p-4">

                        <form method="POST" action="/orders/{{ $order->id }}">
                            @csrf
                            @method('PUT') <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="jewelry_item" class="form-label">Jewelry Item</label>
                                <select class="form-select" id="jewelry_item" name="jewelry_item" required>
                                    <option value="Ring" {{ old('jewelry_item', $order->jewelry_item) == 'Ring' ? 'selected' : '' }}>Ring</option>
                                    <option value="Necklace" {{ old('jewelry_item', $order->jewelry_item) == 'Necklace' ? 'selected' : '' }}>Necklace</option>
                                    <option value="Bracelet" {{ old('jewelry_item', $order->jewelry_item) == 'Bracelet' ? 'selected' : '' }}>Bracelet</option>
                                    <option value="Earrings" {{ old('jewelry_item', $order->jewelry_item) == 'Earrings' ? 'selected' : '' }}>Earrings</option>
                                    <option value="Pendant" {{ old('jewelry_item', $order->jewelry_item) == 'Pendant' ? 'selected' : '' }}>Pendant</option>
                                </select>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="{{ old('quantity', $order->quantity) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Price (₱)</label>
                                    <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" value="{{ old('price', $order->price) }}" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="Pending" {{ old('status', $order->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Processing" {{ old('status', $order->status) == 'Processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="Completed" {{ old('status', $order->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Cancelled" {{ old('status', $order->status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            
                            <div class="mt-4">
                                <button type="submit" class="btn btn-warning px-4 text-dark font-weight-bold">
                                    <i class="fas fa-save me-2"></i>Update Order
                                </button>
                                <a href="/orders" class="btn btn-secondary px-4">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>