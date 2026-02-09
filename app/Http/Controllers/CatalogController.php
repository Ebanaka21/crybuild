<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();

        $brands = Brand::where('is_active', true)
            ->has('products')
            ->withCount('products')
            ->orderBy('name')
            ->get();
        
        // Фильтрация товаров
        $products = Product::with(['category', 'brand', 'images'])
            ->where('is_active', true);
        
        // Фильтр по категории
        if ($request->has('category') && $request->category) {
            $categoryIds = [$request->category];
            $subCategories = Category::where('parent_id', $request->category)->pluck('id');
            $categoryIds = array_merge($categoryIds, $subCategories->toArray());
            $products->whereIn('category_id', $categoryIds);
        }
        
        // Фильтр по брендам
        if ($request->has('brands') && !empty($request->brands)) {
            $products->whereIn('brand_id', (array)$request->brands);
        }
        
        // Фильтр по цене
        if ($request->has('price_from') && $request->price_from) {
            $products->where('price', '>=', $request->price_from);
        }
        if ($request->has('price_to') && $request->price_to) {
            $products->where('price', '<=', $request->price_to);
        }
        
        // Фильтр наличия
        if ($request->has('in_stock') && $request->in_stock) {
            $products->where('stock', '>', 0);
        }
        
        // Сортировка
        $sort = $request->get('sort', 'popular');
        switch ($sort) {
            case 'price_asc':
                $products->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $products->orderBy('price', 'desc');
                break;
            case 'newest':
                $products->orderBy('created_at', 'desc');
                break;
            case 'rating':
                $products->orderBy('rating', 'desc');
                break;
            case 'popular':
            default:
                $products->orderBy('views', 'desc');
                break;
        }
        
        $products = $products->paginate(24)->appends($request->all());
        
        return view('pages.catalog', compact('categories', 'brands', 'products'));
    }
    
    public function category($slug, Request $request)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();

        $brands = Brand::where('is_active', true)
            ->has('products')
            ->withCount('products')
            ->orderBy('name')
            ->get();
        
        // Получаем все дочерние категории
        $categoryIds = [$category->id];
        $childCategories = Category::where('parent_id', $category->id)->pluck('id');
        $categoryIds = array_merge($categoryIds, $childCategories->toArray());
        
        // Фильтрация товаров
        $products = Product::with(['category', 'brand', 'images'])
            ->where('is_active', true)
            ->whereIn('category_id', $categoryIds);
        
        // Фильтр по брендам
        if ($request->has('brands') && !empty($request->brands)) {
            $products->whereIn('brand_id', (array)$request->brands);
        }
        
        // Фильтр по цене
        if ($request->has('price_from') && $request->price_from) {
            $products->where('price', '>=', $request->price_from);
        }
        if ($request->has('price_to') && $request->price_to) {
            $products->where('price', '<=', $request->price_to);
        }
        
        // Фильтр наличия
        if ($request->has('in_stock') && $request->in_stock) {
            $products->where('stock', '>', 0);
        }
        
        // Сортировка
        $sort = $request->get('sort', 'popular');
        switch ($sort) {
            case 'price_asc':
                $products->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $products->orderBy('price', 'desc');
                break;
            case 'newest':
                $products->orderBy('created_at', 'desc');
                break;
            case 'rating':
                $products->orderBy('rating', 'desc');
                break;
            case 'popular':
            default:
                $products->orderBy('views', 'desc');
                break;
        }
        
        $products = $products->paginate(24)->appends($request->all());
        
        $breadcrumbs = [
            ['title' => 'Главная', 'url' => route('home')],
            ['title' => 'Каталог', 'url' => route('catalog.index')],
            ['title' => $category->name, 'url' => null],
        ];
        
        return view('pages.catalog', compact('category', 'categories', 'brands', 'products', 'breadcrumbs'));
    }

    public function brand($slug, Request $request)
    {
        $brand = Brand::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();

        $brands = Brand::where('is_active', true)
            ->has('products')
            ->withCount('products')
            ->orderBy('name')
            ->get();

        // Фильтрация товаров бренда
        $products = Product::with(['category', 'brand', 'images'])
            ->where('is_active', true)
            ->where('brand_id', $brand->id);

        // Фильтр по цене
        if ($request->has('price_from') && $request->price_from) {
            $products->where('price', '>=', $request->price_from);
        }
        if ($request->has('price_to') && $request->price_to) {
            $products->where('price', '<=', $request->price_to);
        }

        // Фильтр наличия
        if ($request->has('in_stock') && $request->in_stock) {
            $products->where('stock', '>', 0);
        }

        // Сортировка
        $sort = $request->get('sort', 'popular');
        switch ($sort) {
            case 'price_asc':
                $products->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $products->orderBy('price', 'desc');
                break;
            case 'newest':
                $products->orderBy('created_at', 'desc');
                break;
            case 'rating':
                $products->orderBy('rating', 'desc');
                break;
            case 'popular':
            default:
                $products->orderBy('views', 'desc');
                break;
        }

        $products = $products->paginate(24)->appends($request->all());

        $breadcrumbs = [
            ['title' => 'Главная', 'url' => route('home')],
            ['title' => 'Каталог', 'url' => route('catalog.index')],
            ['title' => $brand->name, 'url' => null],
        ];

        return view('pages.catalog', compact('brand', 'categories', 'brands', 'products', 'breadcrumbs'));
    }

    public function brands()
    {
        $brands = Brand::where('is_active', true)
            ->has('products')
            ->withCount('products')
            ->orderBy('name')
            ->paginate(24);

        $breadcrumbs = [
            ['title' => 'Главная', 'url' => route('home')],
            ['title' => 'Бренды', 'url' => null],
        ];

        return view('pages.brands', compact('brands', 'breadcrumbs'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return redirect()->route('catalog.index');
        }

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();

        $brands = Brand::where('is_active', true)
            ->has('products')
            ->withCount('products')
            ->orderBy('name')
            ->get();
        
        $products = Product::with(['category', 'brand', 'images'])
            ->where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('sku', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%');
            })
            ->orderBy('views', 'desc')
            ->paginate(24)
            ->appends(['q' => $query]);
        
        $breadcrumbs = [
            ['title' => 'Главная', 'url' => route('home')],
            ['title' => 'Каталог', 'url' => route('catalog.index')],
            ['title' => 'Поиск: ' . $query, 'url' => null],
        ];
        
        return view('pages.catalog', compact('products', 'categories', 'brands', 'breadcrumbs', 'query'));
    }
}
