@props(['categories', 'currentCategory' => null])

<div class="category-tree" x-data="{ expanded: {} }">
    <ul class="space-y-2">
        @foreach($categories as $category)
            <li>
                <div class="flex items-center justify-between">
                    <a href="{{ route('catalog.category', $category->slug) }}"
                       class="flex-1 flex items-center py-2 px-3 rounded-lg transition duration-200
                              {{ $currentCategory && $currentCategory->id === $category->id ? 'bg-orange-100 text-orange-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}">
                        <div class="flex items-center">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}"
                                     alt="{{ $category->name }}"
                                     class="w-6 h-6 mr-2 object-contain">
                            @endif
                            <span>{{ $category->name }}</span>
                        </div>
                    </a>

                    @if($category->children->count() > 0)
                        <button @click="expanded['cat{{ $category->id }}'] = !expanded['cat{{ $category->id }}']"
                                class="p-2 hover:bg-gray-100 rounded-lg transition"
                                :class="expanded['cat{{ $category->id }}'] ? 'rotate-90' : ''">
                            <svg class="w-4 h-4 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @endif
                </div>

                @if($category->children->count() > 0)
                    <div x-show="expanded['cat{{ $category->id }}']"
                         x-transition
                         class="ml-4 mt-1 space-y-1">
                        @foreach($category->children as $child)
                            <a href="{{ route('catalog.category', $child->slug) }}"
                               class="block py-1.5 px-3 rounded-lg text-sm transition duration-200
                                      {{ $currentCategory && $currentCategory->id === $child->id ? 'bg-orange-100 text-orange-700 font-medium' : 'hover:bg-gray-100 text-gray-600' }}">
                                {{ $child->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</div>
