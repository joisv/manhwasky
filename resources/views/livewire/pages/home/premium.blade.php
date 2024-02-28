<div class="w-full max-w-5xl mx-auto " x-data="{
    swiper: null,
    slidePerView: 3,

    init() {
        let slide;

        switch (true) {
            case this.widthValue >= 768:
                slide = 3;
                break;
            case this.widthValue >= 640:
                slide = 3;
                break;
            default:
                slide = 2;
        }
        this.sliderInitGenre(slide)
    },

    sliderInitGenre(slide) {
        this.swiper = new Swiper('.premiumSeries', {
            slidesPerView: slide,
            spaceBetween: 13,
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
            slidePreview = 3;
            break;
        case value >= 640:
            slidePreview = 3;
            break;
        default:
            slidePreview = 2;
    }

    sliderInitGenre(slidePreview);
})">
    <div class="w-full space-y-3">
        <header class="mb-3 sm:mb-8 p-2 sm:p-0">
            <h1 class="text-2xl sm:text-4xl text-gray-600 font-comicBold">Premium</h1>
            <p class="text-gray-400 font-comicRegular text-lg sm:text-xl">Get early access to new chapters and binge-read your favorite series.</p>
        </header>
        <div class="swiper premiumSeries">
            <div class="swiper-wrapper sm:mt-3 px-2 2xl:px-0">
                @empty(!$premiums)
                    @forelse ($premiums as $index => $series)
                        <div class="swiper-slide">
                            <div class="w-full h-40 sm:h-52 relative group cursor-pointer rounded-md"
                                wire:click="redirectTo('{{ $series->slug }}')">
                                <img src="{{ asset('storage/' . $series->gallery->image) ?? '' }}"
                                    class="object-cover object-top w-full h-full blur-sm" alt="" srcset="">
                                    <div class="absolute bottom-0 w-full h-full" style="opacity: 0.7; background-color: {{ $series->genres?->first()?->primary_color }}"></div>
                                <div id="wrapperNewRelease_{{ $index + 1 }}"
                                    class="absolute bottom-0 w-full h-full" >
                                    <div class="space-x-3 px-2 w-full h-full flex items-center">
                                        <img src="{{ asset('storage/' . $series->gallery->image) ?? '' }}" class="sm:w-24 sm:h-36 w-20 h-32 object-cover">
                                        <div class="text-gray-200">
                                            <p class="text-sm sm:text-base font-comicRegular">{{ $series?->genres->first()?->name }}</p>
                                            <h1 class="sm:text-2xl text-xl font-comicBold">{{ $series->title }}</h1>
                                            <div class="flex space-x-1 mt-6 items-center">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="rgb(229, 231, 235)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="rgb(229, 231, 235)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                <span>{{ $series->views }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="px-2 border-x border-b border-gray-400">
                                    <div class="flex sm:hidden justify-between items-center">
                                        <h1 class="group-hover:bg-transparent font-comicBold text-lg "
                                            x-text="sliceStr('{{ $series->title }}', 9)">
                                        </h1>
                                        <p class="text-xs text-primary font-medium">
                                            {{ $series->genres()->first()->name ?? '' }}</p>
                                    </div>
                                    <span class="text-sm text-gray-500 flex sm:hidden">{{ $series->title }}</span>
                                </div> --}}
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
    </div>
</div>
