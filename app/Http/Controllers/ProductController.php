<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with(['category', 'brand', 'images', 'reviews.user'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        // Увеличиваем количество просмотров
        $product->increment('views');

        // Получаем похожие товары (из той же категории)
        $relatedProducts = Product::with(['category', 'brand', 'images'])
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where(function($query) use ($product) {
                $query->where('category_id', $product->category_id)
                      ->orWhere('brand_id', $product->brand_id);
            })
            ->where('stock', '>', 0)
            ->orderBy('views', 'desc')
            ->take(6)
            ->get();

        // Получаем хлебные крошки
        $breadcrumbs = [
            ['title' => 'Главная', 'url' => route('home')],
            ['title' => 'Каталог', 'url' => route('catalog.index')],
            ['title' => $product->category->name, 'url' => route('catalog.category', $product->category->slug)],
            ['title' => $product->name, 'url' => null],
        ];

        return view('pages.product', compact('product', 'relatedProducts', 'breadcrumbs'));
    }
}
