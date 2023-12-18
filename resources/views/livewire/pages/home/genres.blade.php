<div class="min-h-screen" x-data="{
    activeTab: @entangle('selectedGenre').live,
    setSort: false,

    init() {
        document.getElementById(this.activeTab).classList.add('border-b-2', 'border-b-gray-800')
    },
    setGenre(name) {
        $wire.selectedGenre = name;
        $wire.getSeriesWhereGenre()
        $wire.$refresh()
        let clearTabs = document.getElementsByClassName('genresTab');
        for (let tab of clearTabs) {
            tab.classList.remove('border-b-2', 'border-b-gray-800');
        }
        let tab = document.getElementById(name);
        tab.classList.add('border-b-2', 'border-b-gray-800');
    },
    sortBy(sort) {
        $wire.sortDirection = sort;
        $wire.getSeriesWhereGenre();
        $wire.$refresh();
    }
}">
    {{-- mobile: ambil 6/7 data index ke 0-2 show 3-6 hidden --}}
    <div class="sm:h-full h-fit w-full items-center justify-between flex border-gray-300"
        :class="showGenre ? 'border-t' : 'border-y'">
        <div class="swiper genresSlide" wire:ignore x-cloak>
            <div class="swiper-wrapper">
                @foreach ($staticGenre as $index => $genre)
                    <div class="swiper-slide">
                        <button @click="setGenre('{{ $genre->name }}')"
                            class="flex items-center justify-center w-full h-full py-3 genresTab"
                            id="{{ $genre->name }}">
                            <p class="sm:text-lg font-comicRegular text-base">{{ $genre->name }}</p>
                        </button>
                    </div>
                @endforeach
                <div class="col-span-5 lg:col-span-8 xl:col-span-10 text-center font-comicBold text-gray-400 py-3 animate-pulse text-lg"
                    wire:loading>
                    <p>loading...</p>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-center h-full border-l border-gray-300 w-fit sm:px-3">
            <button type="button" @click="showGenre = ! showGenre" class="sm:text-xl font-comicRegular text-sm">
                <x-icons.arrow default="20px" rotate="rotate(90), rotate(180)"
                    color="rgb(209 213 219 / var(--tw-border-opacity))" />
            </button>
        </div>
    </div>
    <div class="space-y-2 w-[96.9%] " x-cloak x-show="showGenre" x-collapse>
        <div class="grid max-[410px]:grid-cols-3 grid-cols-5 lg:grid-cols-8 xl:grid-cols-10" wire:ignore>
            @foreach ($allGenre as $index => $genre)
                <button type="button" @click="setGenre('{{ $genre->name }}')"
                    class="flex items-center justify-center w-full h-full border border-gray-300 py-3 genresTab"
                    id="{{ $genre->name }}">
                    <p class="font-comicRegular text-base sm:text-lg">{{ $genre->name }}</p>
                </button>
            @endforeach
        </div>
    </div>
    <div class="max-w-5xl mx-auto px-2 md:p-0">
        <div class="flex items-center justify-between w-full mt-4" @click.outside="setSort = false">
            <h1 class="text-primary text-xl font-comicBold ">{{ $selectedGenre }}</h1>
            <div class="relative min-w-[10%]">
                <button @click="setSort = ! setSort" class="flex justify-between items-center w-full">
                    <h4>Urutkan berdasar: <span class="font-comicBold">{{ $sortDirection }}</span></h4>
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="w-36 right-2 bg-gray-100 absolute p-2 space-y-1"  x-cloak x-show="setSort" x-transition>
                    @foreach (['All', 'Views', 'Created', 'Updated' , 'Ongoing', 'Pending', 'Finish'] as $sort)
                        <button @click="sortBy('{{ $sort }}')" type="button"
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
        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-0 sm:gap-3 gap-y-16 max-w-5xl mt-2 mx-auto">
            @empty(!$series)
                @forelse ($series as $series)
                    <div class="w-full h-32 sm:h-44 relative group ">
                        <a href="{{ route('content', $series->slug) }}" wire:navigate>
                            <img src="{{ asset('storage/' . $series->gallery->image) ?? '' }}"
                                class="object-cover object-top w-full h-full" alt="" srcset="">
                            <div id="wrapperSeries_{{ $index }}"
                                class="absolute bottom-0 w-full h-full ease-in duration-100 group-hover:bg-opacity-50 "
                                @mouseover="setHover('{{ $series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                                @mouseout="removeHover('{{ $series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                                style="transition: background-color 0.3s ease;">
                                <div
                                    class="absolute text-sm bg-sky-500 text-white right-2 top-2 px-1 flex group-hover:hidden">
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
            <div class="col-span-3 sm:col-span-4 md:col-span-5 min-h-[45vh] justify-center items-center"
                wire:loading.flex>
                <p class="text-3xl text-gray-400 animate-pulse font-comicBold">loading...</p>
            </div>
        </div>
    </div>
</div>
