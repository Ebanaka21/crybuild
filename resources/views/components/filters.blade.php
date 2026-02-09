@props(['brands', 'minPrice', 'maxPrice', 'selectedBrands', 'priceFrom', 'priceTo', 'inStock', 'onSale'])

<div class="bg-white rounded-lg shadow p-4 sticky top-4">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold">Фильтры</h3>
        <button wire:click="resetFilters" class="text-sm text-orange-600 hover:text-orange-700">
            Сбросить
        </button>
    </div>
    
    <!-- Цена -->
    <div class="mb-6">
        <h4 class="font-medium mb-3">Цена, ₽</h4>
        <div class="flex items-center space-x-2">
            <input type="number" 
                   wire:model.live="priceFrom" 
                   placeholder="{{ $minPrice }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            <span class="text-gray-500">—</span>
            <input type="number" 
                   wire:model.live="priceTo" 
                   placeholder="{{ $maxPrice }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
        </div>
    </div>
    
    <!-- Бренды -->
    @if($brands && $brands->count() > 0)
        <div class="mb-6">
            <h4 class="font-medium mb-3">Бренды</h4>
            <div class="space-y-2 max-h-60 overflow-y-auto">
                @foreach($brands as $brand)
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" 
                               value="{{ $brand->id }}" 
                               wire:model.live="selectedBrands"
                               class="w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                        <span class="ml-2 text-sm text-gray-700">{{ $brand->name }}</span>
                        <span class="ml-auto text-xs text-gray-500">({{ $brand->products_count }})</span>
                    </label>
                @endforeach
            </div>
        </div>
    @endif
    
    <!-- Наличие -->
    <div class="mb-6">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" 
                   wire:model.live="inStock"
                   class="w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
            <span class="ml-2 text-sm text-gray-700">В наличии</span>
        </label>
    </div>
    
    <!-- Скидки -->
    <div class="mb-6">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" 
                   wire:model.live="onSale"
                   class="w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
            <span class="ml-2 text-sm text-gray-700">Со скидкой</span>
        </label>
    </div>
    
    <!-- Кнопка применения -->
    <button wire:click="applyFilters" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
        Применить фильтры
    </button>
</div>
