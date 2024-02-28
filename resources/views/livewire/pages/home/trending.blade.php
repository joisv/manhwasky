<div class="space-y-3 w-full border border-gray-300 p-3 rounded-sm min-h-full" wire:init="getTrending">
    {{-- <div>
        <header class="text-xl text-gray-600 font-comicBold">Newsfeed</header>
        <div class="h-16 w-full bg-rose-500"></div>
    </div> --}}
    <div class="space-y-1">
        <header class="text-xl text-gray-600 font-comicBold">Trending</header>
        @empty(!$trending)
            @foreach ($trending as $index => $trending)
                <a href="{{ route('content', $trending->slug) }}" class="flex items-center space-x-3 "
                    @mouseover="setHover('wrapperSeriesTrending_', '{{ $trending->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                    @mouseout="removeHover('wrapperSeriesTrending_', '{{ $trending->genres()->first()->primary_color ?? '' }}', {{ $index }})">
                    <div class="h-24 w-24 relative">
                        <img src="{{ asset('storage/' . $trending->gallery->image) }}" alt=""
                            class="w-full h-full object-cover object-top">
                        <div class="absolute w-24 h-24 top-0 " id="wrapperSeriesTrending_{{ $index }}"  style="transition: background-color 0.3s ease;"></div>
                    </div>
                    <div>
                        <div>
                            <p class="text-xs sm:text-base font-comicRegular">{{ $trending->category->name }}</p>
                            <h3 class="font-comicBold text-lg sm:text-xl">{{ $trending->title }}</h3>
                        </div>
                        <div class="flex space-x-1">
                            <svg width="15px" height="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            <p class="text-xs font-comicRegular text-gray-500">{{ $trending->views }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        @endempty
        <div class="col-span-3 md:col-span-4 min-h-[45vh] justify-center items-center" wire:loading.flex>
            <p class="text-3xl text-gray-400 animate-pulse font-comicBold">loading...</p>
        </div>
    </div>
</div>
