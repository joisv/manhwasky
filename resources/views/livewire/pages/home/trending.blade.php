<div class="space-y-3 w-full border border-gray-300 p-3 rounded-sm min-h-full" wire:init="getTrending">
    <div>
        <header class="text-xl text-gray-600 font-comicBold">Newsfeed</header>
        <div class="h-16 w-full bg-rose-500"></div>
    </div>
    <div class="space-y-1">
        <header class="text-xl text-gray-600 font-comicBold">Trending</header>
        @empty(!$trending)
            @foreach ($trending as $index => $trending)
                <a href="{{ route('content', $trending->slug) }}" class="flex items-center space-x-3 "
                    @mouseover="setHover('wrapperSeriesTrending_', '{{ $trending->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                    @mouseout="removeHover('wrapperSeriesTrending_', '{{ $trending->genres()->first()->primary_color ?? '' }}', {{ $index }})">
                    <div class="h-20 w-20 relative">
                        <img src="{{ asset('storage/' . $trending->gallery->image) }}" alt=""
                            class="w-full h-full object-cover object-top">
                        <div class="absolute w-20  h-20 top-0 " id="wrapperSeriesTrending_{{ $index }}"  style="transition: background-color 0.3s ease;"></div>
                    </div>
                    <div>
                        <h3 class="font-comicBold text-lg">{{ $trending->title }}</h3>
                        <p class="text-sm">
                            {{ Carbon\Carbon::createFromFormat('Y-m-d', $trending->created)->format('F j, Y') }}</p>
                    </div>
                </a>
            @endforeach
        @endempty
        <div class="col-span-3 md:col-span-4 min-h-[45vh] justify-center items-center" wire:loading.flex>
            <p class="text-3xl text-gray-400 animate-pulse font-comicBold">loading...</p>
        </div>
    </div>
</div>
