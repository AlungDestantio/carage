<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        $total = $carts->sum(fn($c) => $c->quantity * $c->product->price);
        return view('cart.index', compact('carts', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id'=>'required|exists:products,id','quantity'=>'required|integer|min:1']);

        $product = Product::findOrFail($request->product_id);
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $cart = Cart::where('user_id', auth()->id())->where('product_id', $request->product_id)->first();
        if ($cart) {
            $cart->increment('quantity', $request->quantity);
        } else {
            Cart::create(['user_id'=>auth()->id(),'product_id'=>$request->product_id,'quantity'=>$request->quantity]);
        }

        return back()->with('success', 'Ditambahkan ke keranjang!');
    }

    public function update(Request $request, int $id)
    {
        $request->validate(['quantity'=>'required|integer|min:1']);
        $cart = Cart::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $cart->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Keranjang diperbarui!');
    }

    public function destroy(int $id)
    {
        Cart::where('id', $id)->where('user_id', auth()->id())->delete();
        return back()->with('success', 'Produk dihapus dari keranjang!');
    }
}
