<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    // 1. Display a listing of the user's orders
    public function index()
    {
        $userId = Auth::id();

        // Fetch orders belonging to this user, sorted by date (newest first)
        $orders = DB::table('orders')
            ->where('user_id', $userId)
            ->orderBy('order_date', 'desc')
            ->get();

        // Render resources/views/orders.blade.php and pass the orders variable
        return view('orders', compact('orders'));
    }
    // 2. Show the Create Order Form
        public function create()
    {
        return view('add_order'); // Looks for resources/views/add_order.blade.php
    }

    // 3. Store a Newly Created Order
    public function store(Request $request)
    {
        // Validate form input fields
        $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'jewelry_item'  => ['required', 'string', 'max:255'],
            'quantity'      => ['required', 'integer', 'min:1'],
            'price'         => ['required', 'numeric', 'min:0'],
            'status'        => ['required', 'in:Pending,Processing,Completed,Cancelled'],
        ]);

        // Calculate the total price automatically backend-side
        $totalPrice = $request->quantity * $request->price;

        // Insert the record into your orders table
        DB::table('orders')->insert([
            'user_id'       => Auth::id(), // Assigns order to the logged-in user
            'customer_name' => $request->customer_name,
            'jewelry_item'  => $request->jewelry_item,
            'quantity'      => $request->quantity,
            'price'         => $request->price,
            'total_price'   => $totalPrice,
            'status'        => $request->status,
            'order_date'    => now(), // Sets current timestamp
        ]);

        // Redirect back to your orders list with a success toast notification
        return redirect()->route('orders.index')
            ->with('toast_message', 'Order added successfully!')
            ->with('toast_type', 'success');
        }
        // 4. Show the Edit Order Form with existing data
    public function edit($id)
    {
        $userId = Auth::id();

        // Find the order but ensure it belongs to the logged-in user
        $order = DB::table('orders')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        // If order doesn't exist or doesn't belong to the user, redirect away
        if (!$order) {
            return redirect()->route('orders.index')
                ->with('toast_message', 'Order not found!')
                ->with('toast_type', 'error');
        }

        return view('edit_order', compact('order')); // Looks for resources/views/edit_order.blade.php
    }

    // 5. Update the Edited Order Data
    public function update(Request $request, $id)
    {
        $userId = Auth::id();

        // Validate incoming data inputs
        $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'jewelry_item'  => ['required', 'string', 'max:255'],
            'quantity'      => ['required', 'integer', 'min:1'],
            'price'         => ['required', 'numeric', 'min:0'],
            'status'        => ['required', 'in:Pending,Processing,Completed,Cancelled'],
        ]);

        // Recalculate total price
        $totalPrice = $request->quantity * $request->price;

        // Perform the database update statement
        $updated = DB::table('orders')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->update([
                'customer_name' => $request->customer_name,
                'jewelry_item'  => $request->jewelry_item,
                'quantity'      => $request->quantity,
                'price'         => $request->price,
                'total_price'   => $totalPrice,
                'status'        => $request->status,
            ]);

        return redirect()->route('orders.index')
            ->with('toast_message', 'Order updated successfully!')
            ->with('toast_type', 'success');
    }

    // 6. Delete an Order (Migrating delete_order.php)
    public function destroy($id)
    {
        $userId = Auth::id();

        // Perform a safe deletion execution mapping matching constraints
        DB::table('orders')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->delete();

        return redirect()->route('orders.index')
            ->with('toast_message', 'Order deleted successfully!')
            ->with('toast_type', 'success');
    }
    }
    
