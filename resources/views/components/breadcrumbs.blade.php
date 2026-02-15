@props(['breadcrumbs'])

@if($breadcrumbs && count($breadcrumbs) > 0)
    <nav class="mb-6" aria-label="Breadcrumb">
        <div class="overflow-x-auto pb-2 -mx-2 sm:-mx-3 md:-mx-4 px-2 sm:px-3 md:px-4">
            <div class="inline-flex items-center space-x-1 sm:space-x-2 text-xs sm:text-sm text-gray-600 whitespace-nowrap">
            <a href="{{ route('home') }}" class="hover:text-orange-600 shrink-0">
                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </a>

            @foreach($breadcrumbs as $index => $breadcrumb)
                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>

                @if($loop->last)
                    <span class="text-gray-900 font-medium truncate">{{ $breadcrumb['title'] }}</span>
                @else
                    <a href="{{ $breadcrumb['url'] }}" class="hover:text-orange-600 truncate">
                        {{ $breadcrumb['title'] }}
                    </a>
                @endif
            @endforeach
            </div>
        </div>
    </nav>
@endif
