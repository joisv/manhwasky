<x-home-layout>
    <x-slot name="seo">
        {!! seo($seo) !!}
    </x-slot>
    <div x-data="{
        showGenre: false,
        swiperGenre: null,
    
        init() {
            let slide;
    
            switch (true) {
                case this.widthValue >= 1280:
                    slide = 10;
                    break;
                case this.widthValue >= 1024:
                    slide = 8;
                    break;
                case this.widthValue >= 640:
                    slide = 5;
                    break;
                case this.widthValue <= 410:
                    slide = 3;
                    break;
                default:
                    slide = 4;
            }
            this.sliderInit(slide)
    
        },
    
        sliderInit(slide) {
            this.swiper = new Swiper('.genresSlide', {
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
        let slidePreview;
    
        switch (true) {
            case value >= 1280:
                slidePreview = 10;
                break;
            case value >= 1024:
                slidePreview = 8;
                break;
            case value >= 640:
                slidePreview = 5;
                break;
            case value <= 410:
                slidePreview = 3;
                break;
            default:
                slidePreview = 4;
        }
    
        sliderInit(slidePreview);
    })">
        <livewire:pages.home.genres :$staticGenre :selectedGenre="$genre"/>
    </div>
</x-home-layout>
