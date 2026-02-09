<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PageController;

// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('home');

// Каталог
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{category:slug}', [CatalogController::class, 'category'])->name('catalog.category');

// Бренды
Route::get('/brands', [CatalogController::class, 'brands'])->name('brands.index');
Route::get('/brands/{brand:slug}', [CatalogController::class, 'brand'])->name('catalog.brand');

// Товар
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

// Поиск
Route::get('/search', [CatalogController::class, 'search'])->name('search');

// Корзина
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Избранное
Route::get('/wishlist', [AccountController::class, 'wishlist'])->name('wishlist')
    ->middleware('auth');

// Оформление заказа
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

// Личный кабинет
Route::middleware('auth')->prefix('account')->name('account.')->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::get('/orders', [AccountController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [AccountController::class, 'orderShow'])->name('orders.show');
    Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
    Route::put('/profile', [AccountController::class, 'updateProfile'])->name('profile.update');
});

// Статические страницы
Route::get('/delivery', [PageController::class, 'delivery'])->name('delivery');
Route::get('/payment', [PageController::class, 'payment'])->name('payment');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');
Route::get('/pages/{page:slug}', [PageController::class, 'show'])->name('page.show');

// Акции
Route::get('/promotions', [HomeController::class, 'promotions'])->name('promotions.index');
Route::get('/promotions/{promotion:slug}', [HomeController::class, 'promotionShow'])->name('promotions.show');

// Блог
Route::get('/blog', [HomeController::class, 'blog'])->name('blog.index');
Route::get('/blog/{article:slug}', [HomeController::class, 'article'])->name('blog.show');

// Магазины
Route::get('/stores', [HomeController::class, 'stores'])->name('stores.index');

// API endpoints
Route::post('/api/cart/add', function (Request $request) {
    $request->validate([
        'product_id' => 'required|integer|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    try {
        $product = \App\Models\Product::findOrFail($request->product_id);
        \Gloudemans\Shoppingcart\Facades\Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->quantity,
            'price' => $product->price,
            'options' => [
                'slug' => $product->slug,
                'sku' => $product->sku,
                'image' => $product->primaryImage() ? asset('storage/' . $product->primaryImage()->image_path) : asset('images/no-image.png'),
            ],
        ]);

        return response()->json(['success' => true, 'message' => 'Товар добавлен в корзину']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
    }
});

Route::post('/api/wishlist/toggle', function (Request $request) {
    if (!auth()->check()) {
        return response()->json(['success' => false, 'message' => 'Требуется авторизация'], 401);
    }

    $request->validate([
        'product_id' => 'required|integer|exists:products,id',
    ]);

    try {
        $wishlist = \App\Models\Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['success' => true, 'message' => 'Товар удалён из избранного']);
        } else {
            \App\Models\Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
            ]);
            return response()->json(['success' => true, 'message' => 'Товар добавлен в избранное']);
        }
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
    }
});

Route::post('/api/callback', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|max:5000',
    ]);

    try {
        \App\Models\CallbackRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'new',
        ]);

        return response()->json(['success' => true, 'message' => 'Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Ошибка при отправке заявки'], 400);
    }
});

Route::post('/api/reviews/create', function (Request $request) {
    if (!auth()->check()) {
        return response()->json(['success' => false, 'message' => 'Требуется авторизация'], 401);
    }

    $request->validate([
        'product_id' => 'required|integer|exists:products,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);

    try {
        \App\Models\Review::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json(['success' => true, 'message' => 'Отзыв успешно добавлен']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
    }
});

require __DIR__.'/auth.php';
