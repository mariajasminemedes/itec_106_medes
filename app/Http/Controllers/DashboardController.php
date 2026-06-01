<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Get the currently logged-in user's ID
        $userId = Auth::id();

        // 2. Fetch statistics for your dashboard metric cards
        $totalOrders = DB::table('orders')->where('user_id', $userId)->count();
        
        $pendingOrders = DB::table('orders')
            ->where('user_id', $userId)
            ->where('status', 'Pending')
            ->count();

        $processingOrders = DB::table('orders')
            ->where('user_id', $userId)
            ->where('status', 'Processing')
            ->count();

        // 3. Fetch all orders belonging to this user to display in your Bootstrap table
        $orders = DB::table('orders')
            ->where('user_id', $userId)
            ->orderBy('order_date', 'desc')
            ->get();

        // 4. Pass all this data directly into your dashboard view
        return view('dashboard', compact('totalOrders', 'pendingOrders', 'processingOrders', 'orders'));
    }
}