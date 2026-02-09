<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Wishlist;

class WishlistComponent extends Component
{
    public $wishlistItems;
    
    protected $listeners = ['wishlistUpdated' => 'loadWishlist'];
    
    public function mount()
    {
        $this->loadWishlist();
    }
    
    public function loadWishlist()
    {
        $this->wishlistItems = Wishlist::with('product')
            ->where('user_id', auth()->id())
            ->get();
    }
    
    public function toggleWishlist($productId)
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();
        
        if ($wishlist) {
            $wishlist->delete();
            session()->flash('success', 'Товар удален из избранного');
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
            ]);
            session()->flash('success', 'Товар добавлен в избранное');
        }
        
        $this->loadWishlist();
        $this->emit('wishlistUpdated');
    }
    
    public function removeFromWishlist($productId)
    {
        Wishlist::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->delete();
        
        $this->loadWishlist();
        $this->emit('wishlistUpdated');
        
        session()->flash('success', 'Товар удален из избранного');
    }
    
    public function addToCart($productId)
    {
        $product = \App\Models\Product::find($productId);
        
        if (!$product || !$product->isInStock()) {
            session()->flash('error', 'Товар недоступен');
            return;
        }
        
        \Gloudemans\Shoppingcart\Facades\Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->getFinalPrice(),
            'options' => [
                'image' => $product->primaryImage() ? 
                    asset('storage/' . $product->primaryImage()->image_path) : 
                    asset('images/no-image.png'),
                'sku' => $product->sku,
            ]
        ]);
        
        $this->emit('cartUpdated');
        session()->flash('success', 'Товар добавлен в корзину');
    }
    
    public function getWishlistCountProperty()
    {
        return Wishlist::where('user_id', auth()->id())->count();
    }
    
    public function render()
    {
        return view('livewire.wishlist-component');
    }
}
