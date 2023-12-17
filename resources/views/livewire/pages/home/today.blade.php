<div wire:init="getSeries" x-data="{
    seriesExpand: $persist(false),
    {{-- series: @entangle('series'), --}}

    init() {},
    setToday(day) {
        $wire.selectedDay = day
        $wire.getSeries()
        $wire.$refresh()
    },
}">
    <div class="flex flex-1 justify-between items-center px-2 sm:hidden">
        <h1 class="font-comicBold text-gray-600 text-2xl">Today</h1>
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
    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-0 sm:gap-3 gap-y-16 max-w-5xl mx-auto sm:mt-3 px-2 sm:px-0">
        @empty(!$chapters)
            @forelse ($chapters as $index => $chapter)
                <div class="w-full h-32 sm:h-44 relative group @if (rand(1, 9) === $index) sm:col-span-2 @endif">
                    <a href="{{ route('content', $chapter->series->slug) }}" wire:navigate>
                        <img src="{{ asset('storage/' . $chapter->series->gallery->image) ?? '' }}"
                            class="object-cover object-top w-full h-full" alt="" srcset="">
                        <div id="wrapperSeries_{{ $index }}"
                            class="absolute bottom-0 w-full h-full ease-in duration-100 group-hover:bg-opacity-50 "
                            @mouseover="setHover('{{ $chapter->series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                            @mouseout="removeHover('{{ $chapter->series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                            style="transition: background-color 0.3s ease;">
                            <div class="absolute text-sm bg-sky-500 text-white right-2 top-2 px-1 flex group-hover:hidden">
                                {{ $chapter->title }}</div>
                            <div
                                class="hidden sm:flex sm:flex-col absolute bottom-2 group-hover:bottom-0 ease-in duration-100 text-white">
                                <p class="p-2 hidden group-hover:flex text-sm"
                                    x-text="sliceStr('{{ $chapter->series->overview }}', 150)">
                                </p>
                                <div
                                    class="group-hover:bg-transparent font-comicBold p-2 bg-primary text-lg hidden sm:flex group-hover:flex sm:flex-col">
                                    <h1>
                                        {{ $chapter->series->title }}
                                    </h1>
                                    <p class="text-sm text-white"></p>

                                </div>
                            </div>
                        </div>
                        <div class="px-2 border-x border-b border-gray-400">
                            <div class="flex sm:hidden justify-between items-center">
                                <h1 class="group-hover:bg-transparent font-comicBold text-lg "
                                    x-text="sliceStr('{{ $chapter->series->title }}', 9)">
                                </h1>
                                <p class="text-xs text-primary font-medium">
                                    {{ $chapter->series->genres()->first()->name ?? '' }}</p>
                            </div>
                            <span class="text-sm text-gray-500 flex sm:hidden">{{ $chapter->title }}</span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-3 sm:col-span-4 md:col-span-5 min-h-[45vh] justify-center items-center flex">
                    <p class="text-3xl text-gray-400 animate-pulse font-comicBold ">tidak ada series</p>
                </div>
            @endforelse
        @endempty
        <div class="col-span-3 sm:col-span-4 md:col-span-5 min-h-[45vh] justify-center items-center" wire:loading.flex>
            <p class="text-3xl text-gray-400 animate-pulse font-comicBold">loading...</p>
        </div>
    </div>
</div>
