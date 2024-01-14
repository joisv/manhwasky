<div class="w-full max-w-5xl mx-auto min-h-[50vh]" x-data="{
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
    <div class="w-full space-y-3">
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
                {{-- <div class="col-span-3 md:col-span-4 min-h-[45vh] justify-center items-center" wire:loading.flex>
                    <p class="text-3xl text-gray-400 animate-pulse font-comicBold">loading...</p>
                </div> --}}
            </div>
        </div>
    </div>
</div>
