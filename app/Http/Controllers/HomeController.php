<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)->where('is_active', true)->with('category')->take(8)->get();
        $categories       = Category::withCount('products')->get();
        $latestArticles   = Article::published()->latest('published_at')->take(3)->get();

        return view('home', compact('featuredProducts', 'categories', 'latestArticles'));
    }
}