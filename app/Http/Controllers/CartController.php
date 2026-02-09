<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::content();
        $subtotal = Cart::subtotal();
        $shippingCost = 0;
        $discount = 0;
        $total = Cart::total();
        
        return view('pages.cart', compact(
            'cartItems',
            'subtotal',
            'shippingCost',
            'discount',
            'total'
        ));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'rowId' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $rowId = $request->rowId;
        $quantity = $request->quantity;
        
        if ($quantity <= 0) {
            Cart::remove($rowId);
        } else {
            Cart::update($rowId, $quantity);
        }
        
        return redirect()->route('cart.index')->with('success', 'Корзина обновлена');
    }
    
    public function remove(Request $request)
    {
        $request->validate([
            'rowId' => 'required|string',
        ]);
        
        Cart::remove($request->rowId);
        
        return redirect()->route('cart.index')->with('success', 'Товар удалён из корзины');
    }
    
    public function clear()
    {
        Cart::destroy();
        
        return redirect()->route('cart.index')->with('success', 'Корзина очищена');
    }
}
