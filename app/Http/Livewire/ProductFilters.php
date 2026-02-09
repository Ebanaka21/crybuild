<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductFilters extends Component
{
    use WithPagination;
    
    public $categoryId;
    public $selectedBrands = [];
    public $minPrice;
    public $maxPrice;
    public $priceFrom;
    public $priceTo;
    public $inStock = false;
    public $onSale = false;
    public $sortBy = 'popular';
    public $perPage = 24;
    
    protected $queryString = [
        'selectedBrands' => ['except' => []],
        'priceFrom' => ['except' => null],
        'priceTo' => ['except' => null],
        'inStock' => ['except' => false],
        'onSale' => ['except' => false],
        'sortBy' => ['except' => 'popular'],
    ];
    
    public function mount($categoryId = null)
    {
        $this->categoryId = $categoryId;
        $this->setPriceRange();
    }
    
    public function setPriceRange()
    {
        $query = Product::query();
        
        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }
        
        $this->minPrice = $query->min('price') ?? 0;
        $this->maxPrice = $query->max('price') ?? 100000;
        
        if (!$this->priceFrom) {
            $this->priceFrom = $this->minPrice;
        }
        if (!$this->priceTo) {
            $this->priceTo = $this->maxPrice;
        }
    }
    
    public function updatedSelectedBrands()
    {
        $this->resetPage();
    }
    
    public function updatedPriceFrom()
    {
        $this->resetPage();
    }
    
    public function updatedPriceTo()
    {
        $this->resetPage();
    }
    
    public function updatedInStock()
    {
        $this->resetPage();
    }
    
    public function updatedOnSale()
    {
        $this->resetPage();
    }
    
    public function updatedSortBy()
    {
        $this->resetPage();
    }
    
    public function resetFilters()
    {
        $this->reset([
            'selectedBrands',
            'priceFrom',
            'priceTo',
            'inStock',
            'onSale',
            'sortBy'
        ]);
        $this->setPriceRange();
        $this->resetPage();
    }
    
    public function getProductsProperty()
    {
        $query = Product::query()
            ->with(['category', 'brand', 'images'])
            ->where('is_active', true);
        
        // Фильтр по категории
        if ($this->categoryId) {
            $category = Category::find($this->categoryId);
            $categoryIds = [$this->categoryId];
            
            if ($category) {
                $childCategories = $category->getAllChildren();
                $categoryIds = array_merge($categoryIds, $childCategories->pluck('id')->toArray());
            }
            
            $query->whereIn('category_id', $categoryIds);
        }
        
        // Фильтр по брендам
        if (!empty($this->selectedBrands)) {
            $query->whereIn('brand_id', $this->selectedBrands);
        }
        
        // Фильтр по цене
        if ($this->priceFrom) {
            $query->where('price', '>=', $this->priceFrom);
        }
        if ($this->priceTo) {
            $query->where('price', '<=', $this->priceTo);
        }
        
        // Фильтр наличия
        if ($this->inStock) {
            $query->where('stock', '>', 0);
        }
        
        // Фильтр скидок
        if ($this->onSale) {
            $query->whereNotNull('old_price')
                  ->whereRaw('old_price > price');
        }
        
        // Сортировка
        switch ($this->sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'popular':
            default:
                $query->orderBy('views', 'desc');
                break;
        }
        
        return $query->paginate($this->perPage);
    }
    
    public function getBrandsProperty()
    {
        $query = Brand::query()
            ->has('products')
            ->withCount('products');
        
        if ($this->categoryId) {
            $category = Category::find($this->categoryId);
            $categoryIds = [$this->categoryId];
            
            if ($category) {
                $childCategories = $category->getAllChildren();
                $categoryIds = array_merge($categoryIds, $childCategories->pluck('id')->toArray());
            }
            
            $query->whereHas('products', function ($q) use ($categoryIds) {
                $q->whereIn('category_id', $categoryIds);
            });
        }
        
        return $query->orderBy('name')->get();
    }
    
    public function render()
    {
        return view('livewire.product-filters', [
            'products' => $this->products,
            'brands' => $this->brands,
        ]);
    }
}
