<div class="w-full max-w-5xl mx-auto min-h-[50vh]" x-data="{
    swiper: null,
    widthValue: window.innerWidth,
    slidePerView: 3,

    init() {
        this.slidePerView = this.widthValue >= 768 ? 4 : 3
        this.sliderInit(this.slidePerView)
        window.addEventListener('resize', () => {
            this.widthValue = window.innerWidth
        });

    },

    sliderInit(slide) {
        this.swiper = new Swiper('.popularGenre', {
            slidesPerView: slide,
            spaceBetween: 15,
            freeMode: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    }
}" x-init="$watch('widthValue', value => {
    slidePerView = value >= 768 ? 4 : 3
    sliderInit(slidePerView)
})">
    <div class="w-full space-y-3">
        <h1 class="text-xl font-comicBold text-gray-600 text-center">Newrelease</h1>
        <div class="swiper popularGenre">
            <div class="swiper-wrapper sm:mt-3 px-2 sm:px-0">
                @empty(!$series)
                    @forelse ($series as $index => $series)
                        <div class="swiper-slide">
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
    </div>
</div>
