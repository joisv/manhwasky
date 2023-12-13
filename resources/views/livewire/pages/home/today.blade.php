<div class="min-h-screen" wire:init="getSeries" x-data="{
    seriesExpand: $persist(false),
    series: @entangle('series'),

    init() {},
    setToday(day) {
        $wire.selectedDay = day
        $wire.getSeries()
        $wire.$refresh()
    },

    setHover(hover, index) {
        const hoverTag = document.getElementById('wrapperSeries_' + index)

        if (hoverTag) {
            hoverTag.style.backgroundColor = hover;
        }
    },

    removeHover(hover, index) {
        const hoverTag = document.getElementById('wrapperSeries_' + index)

        if (hoverTag) {
            hoverTag.style.removeProperty('background-color');
        }
    },

}">
    <div class="space-y-1 relative w-full flex justify-end sm:hidden">
        <button @click="seriesExpand = true" class="p-3 font-semibold flex items-center justify-between space-x-2">
            <p>Diurutkan {{ $selectedDay }}</p>
            <x-icons.check default="24px" />
        </button>
        <div x-cloak @click.outside="seriesExpand = false"
            class="absolute top-0 z-50 bg-gray-100 border border-gray-300 w-1/2" x-show="seriesExpand">
            @foreach ($days as $day)
                <button @click="setToday('{{ $day }}')" type="button"
                    class="p-2 font-semibold w-full text-start flex items-center justify-between">
                    <p>{{ $day }}</p>
                    @if ($day === $selectedDay)
                        <x-icons.check default="24px" />
                    @endif
                </button>
            @endforeach
        </div>
    </div>
    <div class="max-w-5xl h-14 sm:h-20 mx-auto sm:flex justify-between space-x-2 items-center hidden">
        @foreach ($days as $day)
            <div
                class=" w-full h-full flex items-center justify-center font-medium  @if ($day === $selectedDay) bg-primary text-white @endif">
                <button type="button" @click="setToday('{{ $day }}')"
                    class="disabled:text-gray-300 font-comicBold text-sm sm:text-base md:text-xl"
                    wire:loading.attr="disbled">{{ $day }}</button>
            </div>
        @endforeach
    </div>
    <div class="grid grid-cols-3 md:grid-cols-4 sm:gap-3 gap-y-16 max-w-5xl mx-auto sm:mt-3 px-2 sm:px-0">
        @empty(!$series)
            @forelse ($series as $index => $series)
                <div class="w-full h-32 sm:h-44 relative group @if (rand(1, 9) === $index) sm:col-span-2 @endif">
                    <img src="{{ asset('storage/' . $series->gallery->image) ?? '' }}"
                        class="object-cover object-top w-full h-full" alt="" srcset="">
                    <div id="wrapperSeries_{{ $index }}"
                        class="absolute bottom-0 w-full h-full ease-in duration-100 group-hover:bg-opacity-50 "
                        @mouseover="setHover('{{ $series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                        @mouseout="removeHover('{{ $series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                        style="transition: background-color 0.3s ease;">
                        <div class="absolute text-sm bg-sky-500 text-white right-2 top-2 px-1 flex group-hover:hidden">
                            {{ $series->status }}</div>
                        <div class="absolute bottom-2 group-hover:bottom-0 ease-in duration-100 text-white">
                            <p class="p-2 hidden group-hover:flex text-sm"
                                x-text="sliceStr('{{ $series->overview }}', 20)">
                            </p>
                            <h1
                                class="group-hover:bg-transparent font-comicBold p-2 bg-primary text-lg hidden group-hover:flex">
                                {{ $series->title }}
                            </h1>
                        </div>
                    </div>
                    <div class="flex sm:hidden justify-between items-center pr-2">
                        <h1 class="group-hover:bg-transparent font-comicBold text-lg " x-text="sliceStr('{{ $series->title  }}', 9)">
                        </h1>
                        <p class="text-sm text-primary font-medium">{{ $series->genres()->first()->name ?? '' }}</p>
                    </div>
                    <span class="text-sm font-comicBold text-primary flex sm:hidden">Chapter 109</span>
                </div>
            @empty
                <div class="col-span-3 md:col-span-4  min-h-[45vh] justify-center items-center flex">
                    <p class="text-3xl text-gray-400 animate-pulse font-comicBold ">tidak ada series</p>
                </div>
            @endforelse
        @endempty
        <div class="col-span-3 md:col-span-4 min-h-[45vh] justify-center items-center" wire:loading.flex>
            <p class="text-3xl text-gray-400 animate-pulse font-comicBold">loading...</p>
        </div>
    </div>
</div>
