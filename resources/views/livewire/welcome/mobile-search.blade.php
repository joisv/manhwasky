<div>
    <div class="justify-center">
        <div class="flex items-center w-full">
            <span class="absolute right-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </span>
            <input type="text" wire:model.live.debounce.500ms="searchInput" placeholder="search" class="block w-full py-1.5 pr-2 text-gray-700 bg-white border border-gray-200 rounded-lg placeholder-gray-400/70 pl-4 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
        </div>
        {{-- <x-search wire:model.live.debounce.500ms="searchInput" /> --}}
    </div>
    @empty(!$searchInput)
        <div class=" w-full min-h-[80px] bg-gray-100 rounded-sm ">
            @empty(!$searchValue)
                @forelse ($searchValue as $series)
                    <a href="{{ route('content', $series->slug) }}" class="flex justify-between items-center p-2 hover:bg-gray-200 ease-in duration-100 cursor-pointer"
                        wire:loading.remove wire:navigate @click="show = false">
                        <h1 class="font-comicBold" x-text="sliceStr('{{ $series->title }}', 9)"></h1>
                        <p class="text-sm">{{ Carbon\Carbon::createFromFormat('Y-m-d', $series->created)->format('F j, Y') }}</p>
                    </a>
                @empty
                    <div class="min-h-[80px] flex w-full justify-center items-center" wire:loading.remove>
                        <h1 class="font-comicBold text-gray-500 ">Series ngga ada/ngga ketemu</h1>
                    </div>
                @endforelse
            @endempty
            <div class=" min-h-[80px] w-full justify-center items-center animate-pulse" wire:loading.flex>
                <h1 class="font-comicBold text-gray-500">Loading <span class="animate-bounce">...</span></h1>
            </div>
        </div>
    @endempty
</div>
