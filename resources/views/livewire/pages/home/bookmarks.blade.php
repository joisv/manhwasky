<div class="mx-auto max-w-5xl min-h-screen" wire:init="getBookmarks">
    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-0 sm:gap-3 gap-y-16 max-w-5xl mt-2 mx-auto">
        @empty(!$bookmarks)
            @forelse ($bookmarks as $index => $series)
                <div class="w-full h-32 sm:h-44 relative group " wire:loading.remove>
                    <a href="{{ route('content', $series->slug) }}" wire:navigate>
                        <img src="{{ asset('storage/' . $series->gallery->image) ?? '' }}"
                            class="object-cover object-top w-full h-full" alt="" srcset="">
                        <div id="wrapperSeries_{{ $index }}"
                            class="absolute bottom-0 w-full h-full ease-in duration-100 group-hover:bg-opacity-50 "
                            @mouseover="setHover('wrapperSeriesBookmark_', '{{ $series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                            @mouseout="removeHover('wrapperSeriesBookmark_', '{{ $series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                            style="transition: background-color 0.3s ease;">
                            <div class="absolute text-sm bg-sky-500 text-white right-2 top-2 px-1 flex group-hover:hidden">
                                {{ $series->title }}</div>
                            <div
                                class="hidden sm:flex sm:flex-col absolute bottom-2 group-hover:bottom-0 ease-in duration-100 text-white">
                                <p class="p-2 hidden group-hover:flex text-sm"
                                    x-text="sliceStr('{{ $series->overview }}', 150)">
                                </p>
                                <div
                                    class="group-hover:bg-transparent font-comicBold p-2 bg-primary text-lg hidden sm:flex group-hover:flex sm:flex-col">
                                    <h1>
                                        {{ $series->title }}
                                    </h1>
                                    <p class="text-sm text-white"></p>

                                </div>
                            </div>
                        </div>
                        <div class="px-2 border-x border-b border-gray-400">
                            <div class="flex sm:hidden justify-between items-center">
                                <h1 class="group-hover:bg-transparent font-comicBold text-lg "
                                    x-text="sliceStr('{{ $series->title }}', 9)">
                                </h1>
                                <p class="text-xs text-primary font-medium">
                                    {{ $series->genres()->first()->name ?? '' }}</p>
                            </div>
                            <span class="text-sm text-gray-500 flex sm:hidden">{{ $series->title }}</span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-3 sm:col-span-4 md:col-span-5  min-h-[45vh] justify-center items-center flex">
                    <p class="text-3xl text-gray-400 animate-pulse font-comicBold ">tidak ada series</p>
                </div>
            @endforelse
        @endempty
        <div class="col-span-3 sm:col-span-4 md:col-span-5 min-h-[45vh] justify-center items-center" wire:loading.flex>
            <p class="text-3xl text-gray-400 animate-pulse font-comicBold">loading...</p>
        </div>
    </div>
</div>
