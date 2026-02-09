<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{
    public $cartItems;
    public $subtotal;
    public $shippingCost = 0;
    public $discount = 0;
    public $total;
    
    protected $listeners = ['cartUpdated' => 'loadCart'];
    
    public function mount()
    {
        $this->loadCart();
    }
    
    public function loadCart()
    {
        $this->cartItems = Cart::content();
        $this->subtotal = Cart::subtotal();
        $this->total = Cart::total();
    }
    
    public function addToCart($productId, $quantity = 1)
    {
        $product = \App\Models\Product::find($productId);
        
        if (!$product || !$product->isInStock()) {
            session()->flash('error', 'Товар недоступен');
            return;
        }
        
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $quantity,
            'price' => $product->getFinalPrice(),
            'options' => [
                'image' => $product->primaryImage() ? 
                    asset('storage/' . $product->primaryImage()->image_path) : 
                    asset('images/no-image.png'),
                'sku' => $product->sku,
            ]
        ]);
        
        $this->loadCart();
        $this->emit('cartUpdated');
        
        session()->flash('success', 'Товар добавлен в корзину');
    }
    
    public function updateQuantity($rowId, $quantity)
    {
        if ($quantity <= 0) {
            return $this->removeFromCart($rowId);
        }
        
        Cart::update($rowId, $quantity);
        $this->loadCart();
        $this->emit('cartUpdated');
    }
    
    public function removeFromCart($rowId)
    {
        Cart::remove($rowId);
        $this->loadCart();
        $this->emit('cartUpdated');
        
        session()->flash('success', 'Товар удален из корзины');
    }
    
    public function clearCart()
    {
        Cart::destroy();
        $this->loadCart();
        $this->emit('cartUpdated');
        
        session()->flash('success', 'Корзина очищена');
    }
    
    public function getCartCountProperty()
    {
        return Cart::count();
    }
    
    public function render()
    {
        return view('livewire.cart-component');
    }
}
