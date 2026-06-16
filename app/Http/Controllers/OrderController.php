<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout()
    {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        if ($carts->isEmpty()) return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');

        $subtotal = $carts->sum(fn($c) => $c->quantity * $c->product->price);
        $shipping = 25000;
        $total    = $subtotal + $shipping;

        return view('order.checkout', compact('carts', 'subtotal', 'shipping', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient_name'  => 'required|string|max:100',
            'recipient_phone' => 'required|string|max:20',
            'shipping_address'=> 'required|string',
            'payment_method'  => 'required|in:transfer,cod,qris',
        ]);

        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        if ($carts->isEmpty()) return redirect()->route('cart.index');

        $subtotal = $carts->sum(fn($c) => $c->quantity * $c->product->price);
        $shipping = 25000;

        $order = Order::create([
            'user_id'          => auth()->id(),
            'order_number'     => 'CRG-'.strtoupper(Str::random(8)),
            'total_amount'     => $subtotal + $shipping,
            'shipping_cost'    => $shipping,
            'status'           => 'pending',
            'payment_status'   => 'unpaid',
            'payment_method'   => $request->payment_method,
            'shipping_address' => $request->shipping_address,
            'recipient_name'   => $request->recipient_name,
            'recipient_phone'  => $request->recipient_phone,
            'notes'            => $request->notes,
        ]);

        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $cart->product_id,
                'quantity'   => $cart->quantity,
                'price'      => $cart->product->price,
            ]);
            $cart->product->decrement('stock', $cart->quantity);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('order.show', $order->id)->with('success', 'Pesanan berhasil dibuat!');
    }

    public function history(Request $request)
    {
        $validStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

        $orders = Order::where('user_id', auth()->id())
            ->when(
                $request->filled('status') && in_array($request->status, $validStatuses),
                fn($q) => $q->where('status', $request->status)
            )
            ->latest()
            ->paginate(10)
            ->withQueryString(); // agar status ikut terbawa saat pindah halaman

        return view('order.history', compact('orders'));
    }

    public function show(int $id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->with('orderItems.product')
            ->firstOrFail();

        return view('order.show', compact('order'));
    }
}