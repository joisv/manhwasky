<div class="relative space-y-2" x-cloak x-show="setSearchOpen">
    <x-search class="focus:ring-0 focus:border-primary p-0" @click.outside="setSearchOpen = false"
        wire:model.live.debounce.500ms="searchInput" />
    @empty(!$searchInput)
        <div class="absolute w-full min-h-[80px] bg-gray-100 rounded-sm ">
            @empty(!$searchValue)
                @forelse ($searchValue as $series)
                    <a href="{{ route('content', $series->slug) }}" class="flex justify-between items-center p-2 hover:bg-gray-200 ease-in duration-100 cursor-pointer"
                        wire:loading.remove wire:navigate>
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
