<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Cart::count() === 0) {
            return redirect()->route('cart.index');
        }
        
        $cartItems = Cart::content();
        $subtotal = (float)str_replace([',', ' '], '', Cart::subtotal());
        $shippingCost = 0;
        $discount = 0;
        $total = (float)str_replace([',', ' '], '', Cart::total());
        
        return view('pages.checkout', compact(
            'cartItems',
            'subtotal',
            'shippingCost',
            'discount',
            'total'
        ));
    }
    
    public function store(Request $request)
    {
        if (Cart::count() === 0) {
            return redirect()->route('cart.index');
        }
        
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'shipping_address' => 'required|string',
            'postal_code' => 'nullable|string|max:20',
            'delivery_method' => 'required|in:pickup,courier,post',
            'payment_method' => 'required|in:cash,card,online',
            'comment' => 'nullable|string',
        ]);
        
        DB::beginTransaction();
        
        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'city' => $validated['city'],
                'shipping_address' => $validated['shipping_address'],
                'postal_code' => $validated['postal_code'],
                'subtotal' => (float)str_replace([',', ' '], '', Cart::subtotal()),
                'shipping_cost' => $validated['delivery_method'] === 'pickup' ? 0 : 500,
                'discount' => 0,
                'total' => (float)str_replace([',', ' '], '', Cart::total()) + ($validated['delivery_method'] === 'pickup' ? 0 : 500),
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
                'delivery_method' => $validated['delivery_method'],
                'status' => 'new',
                'comment' => $validated['comment'],
            ]);
            
            foreach (Cart::content() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'product_name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $item->qty,
                    'total' => $item->qty * $item->price,
                ]);
            }
            
            Cart::destroy();
            
            DB::commit();

            return redirect()->route('account.orders')->with('success', 'Заказ успешно оформлен!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Ошибка при оформлении заказа. Попробуйте еще раз.');
        }
    }
}
