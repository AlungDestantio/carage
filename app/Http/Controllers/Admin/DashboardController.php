<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Article;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders'   => Order::count(),
            'total_products' => Product::count(),
            'total_users'    => User::where('role','customer')->count(),
            'total_revenue'  => Order::where('payment_status','paid')->sum('total_amount'),
            'pending_orders' => Order::where('status','pending')->count(),
        ];
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $lowStock     = Product::where('stock', '<', 10)->where('is_active', true)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'lowStock'));
    }
}