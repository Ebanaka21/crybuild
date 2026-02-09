<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Убрали ВСЁ кэширование - админка теперь работает сразу!
        $banners = Banner::where('is_active', true)
            ->where('position', 'main_slider')
            ->orderBy('order')
            ->get();

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get();

        $brands = Brand::where('is_active', true)
            ->has('products')
            ->withCount('products')
            ->orderBy('name')
            ->take(6)
            ->get();

        $featuredProducts = Product::with(['category', 'brand', 'images'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->where('stock', '>', 0)
            ->orderBy('views', 'desc')
            ->take(6)
            ->get();

        $newProducts = Product::with(['category', 'brand', 'images'])
            ->where('is_active', true)
            ->where('is_new', true)
            ->where('stock', '>', 0)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $promotions = Promotion::where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $articles = Article::where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
        
        return view('pages.home', compact(
            'banners',
            'categories',
            'brands',
            'featuredProducts',
            'newProducts',
            'promotions',
            'articles'
        ));
    }
    
    public function promotions()
    {
        // Показываем только активные акции в пределах дат
        $promotions = Promotion::where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // ОТЛАДКА: Если акций нет, покажем почему
        if ($promotions->count() === 0) {
            \Log::info('Акции не найдены. Сейчас: ' . now());
            \Log::info('Все акции в БД:', Promotion::select('name', 'is_active', 'start_date', 'end_date')->get()->toArray());
        }

        return view('pages.promotions', compact('promotions'));
    }
    
    public function promotionShow($slug)
    {
        $promotion = Promotion::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        $products = $promotion->products()
            ->with(['category', 'brand', 'images'])
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->paginate(24);
        
        $breadcrumbs = [
            ['title' => 'Главная', 'url' => route('home')],
            ['title' => 'Акции', 'url' => route('promotions.index')],
            ['title' => $promotion->name, 'url' => null],
        ];
        
        return view('pages.promotion', compact('promotion', 'products', 'breadcrumbs'));
    }
    
    public function blog()
    {
        $articles = Article::where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        // ОТЛАДКА: Если статей нет, покажем почему
        if ($articles->count() === 0) {
            \Log::info('Статьи не найдены. Сейчас: ' . now());
            \Log::info('Все статьи в БД:', Article::select('title', 'is_published', 'published_at')->get()->toArray());
        }

        return view('pages.blog', compact('articles'));
    }
    
    public function article($slug)
    {
        $article = Article::with('user')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
        
        // Увеличиваем количество просмотров
        $article->increment('views');
        
        // Получаем похожие статьи
        $relatedArticles = Article::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
        
        $breadcrumbs = [
            ['title' => 'Главная', 'url' => route('home')],
            ['title' => 'Идеи и советы', 'url' => route('blog.index')],
            ['title' => $article->title, 'url' => null],
        ];
        
        return view('pages.article', compact('article', 'relatedArticles', 'breadcrumbs'));
    }
    
    public function stores()
    {
        $stores = \App\Models\Store::where('is_active', true)
            ->orderBy('name')
            ->get();
        
        return view('pages.stores', compact('stores'));
    }
}
