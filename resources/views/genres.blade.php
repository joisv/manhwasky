@php
    $i = 0;
@endphp
<x-home-layout>
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
                default:
                    slide = 5;
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
            default:
                slidePreview = 5;
        }
    
        sliderInit(slidePreview);
    })" >
        <livewire:pages.home.genres />
    </div>
</x-home-layout>
