<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();

        return view('admin.dashboard', compact('totalProducts', 'totalCategories'));
    }
}


