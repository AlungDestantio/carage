<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with('category');

        if ($request->filled('kategori')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->kategori));
        }
        if ($request->filled('cari')) {
            $query->where('name', 'like', '%'.$request->cari.'%');
        }
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }
        $sort = $request->get('sort', 'newest');
        match($sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'popular'    => $query->orderBy('is_featured', 'desc'),
            default      => $query->latest(),
        };

        $products   = $query->paginate(12)->withQueryString();
        $categories = Category::all();
        $brands     = Product::distinct()->pluck('brand')->filter();

        return view('products.index', compact('products', 'categories', 'brands'));
    }

    public function show(string $slug)
    {
        $product  = Product::where('slug', $slug)->where('is_active', true)->with('category')->firstOrFail();
        $related  = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->where('is_active', true)->take(4)->get();

        return view('products.show', compact('product', 'related'));
    }
}