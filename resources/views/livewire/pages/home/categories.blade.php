<div class="min-h-screen max-w-5xl mx-auto" x-data="{
    setSortCategory: false,
    setSortSeries: false,

    sortSeriesBy(sort) {
        $wire.sortDirection = sort;
        $wire.getSeriesCategory();
        $wire.$refresh()
    },
    sortCategory(sort) {
        $wire.category = sort;
        $wire.getSeriesCategory();
        $wire.$refresh()
    }
}">
    <div class="flex items-center justify-between w-full mt-4"
        @click.outside="() => {
        setSortCategory = false;    
        setSortSeries = false;    
    }">
        <div class="relative min-w-[17%]">
            <button @click="setSortSeries = ! setSortSeries" class="flex space-x-2 items-center w-fit">
                <h1 class="text-primary text-xl font-comicBold ">{{ $category }}</h1>
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <div class="w-full left-1 bg-gray-100 absolute p-2 space-y-1 z-50" x-cloak x-show="setSortSeries" x-transition>
                @foreach ($categories as $categ)
                    <button @click="sortCategory('{{ $categ->name }}')" type="button"
                        class="w-full text-start flex items-center justify-between">
                        <p>{{ $categ->name }}</p>
                        @if ($categ->name === $category)
                            <x-icons.check default="14px" />
                        @endif
                    </button>
                @endforeach
            </div>
        </div>

        <div class="relative min-w-[10%]">
            <button @click="setSortCategory = ! setSortCategory" class="flex justify-between items-center w-full">
                <h4>Urutkan berdasar: <span class="font-comicBold">{{ $sortDirection }}</span></h4>
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <div class="w-36 right-2 bg-gray-100 absolute p-2 space-y-1 z-50" x-cloak x-show="setSortCategory" x-transition>
                @foreach (['All', 'Views', 'Created', 'Updated', 'Ongoing', 'Pending', 'Finish'] as $sort)
                    <button @click="sortSeriesBy('{{ $sort }}')" type="button"
                        class="w-full text-start flex items-center justify-between">
                        <p>{{ $sort }}</p>
                        @if ($sort === $sortDirection)
                            <x-icons.check default="14px" />
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
    </div>
    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-0 sm:gap-3 gap-y-16 max-w-5xl mt-2 mx-auto px-2 2xl:px-0">
        @empty(!$series)
            @forelse ($series as $index => $series)
                <div class="w-full h-32 sm:h-44 relative group " wire:loading.remove>
                    <a href="{{ route('content', $series->slug) }}" wire:navigate>
                        <img src="{{ asset('storage/' . $series->gallery->image) ?? '' }}"
                            class="object-cover object-top w-full h-full" alt="" srcset="">
                        <div id="wrapperSeriesCategory_{{ $index }}"
                            class="absolute bottom-0 w-full h-full ease-in duration-100 group-hover:bg-opacity-50 "
                            @mouseover="setHover('wrapperSeriesCategory_', '{{ $series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                            @mouseout="removeHover('wrapperSeriesCategory_', '{{ $series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
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
                        <div>
                            <div class="sm:hidden justify-between items-center">
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
