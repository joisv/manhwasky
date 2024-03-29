@php
    $rand = rand(2, 7);
    if ($rand === 4) {
        $rand =+ 1;
    }
@endphp
<div class="w-full max-w-5xl mx-auto" x-data="{
    swiper: null,
    slidePerView: 3,

    init() {
        let slide;

        switch (true) {
            case this.widthValue >= 768:
                slide = 5;
                break;
            case this.widthValue >= 640:
                slide = 4;
                break;
            default:
                slide = 3;
        }
        this.sliderInitGenre(slide)
    },

    sliderInitGenre(slide) {
        this.swiper = new Swiper('.popularGenre', {
            slidesPerView: slide,
            spaceBetween: 8,
            freeMode: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    }
}" x-init="$watch('widthValue', value => {
    let slidePreview;

    switch (true) {
        case value >= 768:
            slidePreview = 5;
            break;
        case value >= 640:
            slidePreview = 4;
            break;
        default:
            slidePreview = 3;
    }

    sliderInitGenre(slidePreview);
})">
    <header class="mb-3 sm:mb-8 p-2 sm:p-0">
        <h1 class="text-2xl sm:text-4xl text-gray-600 font-comicBold">New Releases</h1>
        <p class="text-gray-400 font-comicRegular text-lg sm:text-xl">Check out the latest manhwa/comics that just dropped</p>
    </header>
    {{-- <div class="w-full space-y-3">
        <h1 class="text-xl font-comicBold text-gray-600 text-center">Newrelease</h1>
        <div class="swiper popularGenre">
            <div class="swiper-wrapper sm:mt-3 px-2 2xl:px-0">
                @empty(!$series)
                    @forelse ($series as $index => $series)
                        <div class="swiper-slide">
                            <div class="w-full h-32 sm:h-44 relative group cursor-pointer" wire:click="redirectTo('{{ $series->slug }}')">
                                    <img src="{{ asset('storage/' . $series->gallery->image) ?? '' }}"
                                        class="object-cover object-top w-full h-full" alt="" srcset="">
                                    <div id="wrapperNewRelease_{{ $index + 1 }}"
                                        class="absolute bottom-0 w-full h-full ease-in duration-100 group-hover:bg-opacity-50 "
                                        @mouseover="setHover('wrapperNewRelease_', '{{ $series->genres()->first()->primary_color ?? '' }}', {{ $index + 1 }})"
                                        @mouseout="removeHover('wrapperNewRelease_', '{{ $series->genres()->first()->primary_color ?? '' }}', {{ $index + 1 }})"
                                        style="transition: background-color 0.3s ease;">
                                        <div
                                            class="absolute text-sm bg-sky-500 text-white right-0 sm:right-2 top-2 px-1 flex group-hover:hidden">
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
                            </div>
                        </div>
                    @empty
                        <div class="min-h-[45vh] justify-center items-center flex w-full">
                            <p class="text-3xl text-gray-400 animate-pulse font-comicBold ">tidak ada series</p>
                        </div>
                    @endforelse
                @endempty
            </div>
        </div>
    </div> --}}
    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-y-8 gap-x-2 sm:gap-y-16 max-w-5xl mx-auto mt-3 px-2 2xl:px-0">
        @empty(!$series)
            @forelse ($series as $index => $series)
                <div class="w-full h-32 sm:h-44 relative group @if ($rand === $index) sm:col-span-2 @endif"
                    wire:loading.remove>
                    <a href="{{ route('content', $series->slug) }}" wire:navigate>
                        <img src="{{ asset('storage/' . $series->gallery->image) ?? '' }}"
                            class="object-cover object-top w-full h-full" alt="" srcset="">
                        <div id="wrapperSeries_{{ $index }}"
                            class="absolute bottom-0 w-full h-full ease-in duration-100 group-hover:bg-opacity-50 "
                            @mouseover="setHover('wrapperSeries_', '{{ $series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                            @mouseout="removeHover('wrapperSeries_', '{{ $series->genres()->first()->primary_color ?? '' }}', {{ $index }})"
                            style="transition: background-color 0.3s ease;">
                            <div
                                class="absolute text-sm bg-sky-500 text-white right-0 sm:right-2 top-2 px-1 flex group-hover:hidden">
                                {{ $series->category->name }}</div>
                            <div
                                class="hidden sm:flex sm:flex-col absolute bottom-2 group-hover:bottom-0 ease-in duration-100 text-white">
                                <p class="p-2 hidden group-hover:flex text-sm"
                                    x-text="sliceStr('{{ $series->overview }}', 150)">
                                </p>
                                {{-- <div
                                    class="group-hover:bg-transparent font-comicBold p-2 bg-primary text-lg hidden sm:flex group-hover:flex sm:flex-col">
                                    <h1>
                                        {{ $series->title }}
                                    </h1>
                                    <p class="text-sm text-white"></p>

                                </div> --}}
                            </div>
                        </div>
                        <div>
                            <div class=" justify-between items-center">
                                <h1 class="group-hover:bg-transparent font-comicBold text-lg "
                                    x-text="sliceStr('{{ $series->title }}', 9)">
                                </h1>
                                <p class="text-xs text-primary font-medium">
                                    {{ $series->genres()->first()->name ?? '' }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-3 sm:col-span-4 md:col-span-5 min-h-[45vh] justify-center items-center flex"
                    wire:loading.remove>
                    <p class="text-3xl text-gray-400 animate-pulse font-comicBold ">tidak ada series</p>
                </div>
            @endforelse
        @endempty
        <div class="col-span-3 sm:col-span-4 md:col-span-5 min-h-[45vh] justify-center items-center" wire:loading.flex>
            <p class="text-3xl text-gray-400 animate-pulse font-comicBold">loading...</p>
        </div>
    </div>
</div>
