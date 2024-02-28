@php
    $rand = rand(2, 7);
    if ($rand === 4) {
        $rand =+ 1;
    }
@endphp
<div wire:init="getSeries" class="min-h-[50vh]" x-data="{
    seriesExpand: $persist(false),
    swiperGenre: null,
    selectedDay: @entangle('selectedDay'),

    init() {
        let slide;
        document.getElementById(this.selectedDay).classList.add('sm:bg-primary', 'sm:text-white', 'border-b', 'border-b-gray-800')
        switch (true) {
            {{-- case this.widthValue >= 1280:
                slide = 10;
                break; --}}
            case this.widthValue >= 640:
                slide = 7;
                break;
            default:
                slide = 5;
        }
        this.sliderInitToday(slide)

    },
    
    sliderInitToday(slide) {
        this.swiper = new Swiper('.todaySlide', {
            slidesPerView: slide,
            spaceBetween: 15,
            freeMode: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    },
    setToday(day) {
        $wire.selectedDay = day
        $wire.getSeries()
        $wire.$refresh()

        let clearTabs = document.getElementsByClassName('swiper-days');
        for (let tab of clearTabs) {
            tab.classList.remove('sm:bg-primary', 'sm:text-white', 'border-b', 'border-b-gray-800');
        }
        document.getElementById(day).classList.add('sm:bg-primary', 'sm:text-white', 'border-b', 'border-b-gray-800');
    },
}" x-init="$watch('widthValue', value => {
    let slidePreview;

    switch (true) {
        {{-- case value >= 1280:
            slidePreview = 10;
            break; --}}
        case value >= 640:
            slidePreview = 7;
            break;
        default:
            slidePreview = 5;
    }

    sliderInitToday(slidePreview);
})">
    <div class="swiper todaySlide max-w-5xl h-10 sm:h-20 mx-auto " wire:ignore>
        <div class="swiper-wrapper">
            @foreach ($days as $index => $day)
                <div class="swiper-slide">
                    <div
                        class=" w-full h-full flex items-center justify-center font-medium swiper-days px-1" id="{{ $day }}">
                        <button type="button" @click="setToday('{{ $day }}')"
                            class="disabled:text-gray-300 font-comicBold text-sm sm:text-base md:text-xl"
                            wire:loading.attr="disbled">{{ $day }}</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div
        class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-y-8 gap-x-2 sm:gap-y-16 max-w-5xl mx-auto mt-3 px-2 2xl:px-0">
        @empty(!$chapters)
            @forelse ($chapters as $index => $chapter)
                <div class="w-full h-32 sm:h-44 relative group @if ($rand === $index) sm:col-span-2 @endif" wire:loading.remove>
                    <a href="{{ route('content', $chapter->series->slug) }}" wire:navigate>
                        <img src="{{ asset('storage/' . $chapter->series->gallery->image) ?? '' }}"
                            class="object-cover object-top w-full h-full" alt="" srcset="">
                        <div id="wrapperSeries_{{ $index }}"
                            class="absolute bottom-0 w-full h-full ease-in duration-100 group-hover:bg-opacity-50 "
                            @mouseover="setHover('wrapperSeries_', '{{ $chapter->series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                            @mouseout="removeHover('wrapperSeries_', '{{ $chapter->series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                            style="transition: background-color 0.3s ease;">
                            <div class="absolute text-sm bg-sky-500 text-white right-0 sm:right-2 top-2 px-1 flex group-hover:hidden">
                                {{ $chapter->series->category->name }}</div>
                            <div
                                class="hidden sm:flex sm:flex-col absolute bottom-2 group-hover:bottom-0 ease-in duration-100 text-white">
                                <p class="p-2 hidden group-hover:flex text-sm"
                                    x-text="sliceStr('{{ $chapter->series->overview }}', 150)">
                                </p>
                                {{-- <div
                                    class="group-hover:bg-transparent font-comicBold p-2 bg-primary text-lg hidden sm:flex group-hover:flex sm:flex-col">
                                    <h1>
                                        {{ $chapter->series->title }}
                                    </h1>
                                    <p class="text-sm text-white"></p>

                                </div> --}}
                            </div>
                        </div>
                        <div>
                            <div class="justify-between items-center">
                                <h1 class="group-hover:bg-transparent font-comicBold text-lg "
                                    x-text="sliceStr('{{ $chapter->series->title }}', 9)">
                                </h1>
                                <p class="text-xs text-primary font-medium">
                                    {{ $chapter->series->genres()->first()->name ?? '' }}</p>
                            </div>
                            <span class="text-sm text-gray-500">{{ $chapter->title }}</span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-3 sm:col-span-4 md:col-span-5 min-h-[45vh] justify-center items-center flex" wire:loading.remove>
                    <p class="text-3xl text-gray-400 animate-pulse font-comicBold ">tidak ada series</p>
                </div>
            @endforelse
        @endempty
        <div class="col-span-3 sm:col-span-4 md:col-span-5 min-h-[45vh] justify-center items-center" wire:loading.flex>
            <p class="text-3xl text-gray-400 animate-pulse font-comicBold">loading...</p>
        </div>
    </div>
</div>
