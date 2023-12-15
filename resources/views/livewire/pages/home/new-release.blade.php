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
                <div class="swiper-slide">
                    <div class="w-full h-32 sm:h-44 relative group ">
                        <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEi5zCJnNbqIdRNSkPGqYi7GPdysgDY-v7SAy3paTIsjygpRwIQ7UCAyCd3UKxT04h4z31SfiXTOq244niVcltNcR3Mxle89ild1xfJ_LFzfWq36YtWYmPA0jV83I31iaDR-sEsYe1nKucV38ucT9bGXQd9nEfJjGdALmhEf4SvykBx1G_3Xmn2Z2lZv/w600-h337-p-k-no-nu/%ED%83%91%ED%88%B0_%EC%9B%B9%ED%88%B0_%ED%95%98%EC%88%99%EC%9D%BC%EA%B8%B0.png"
                            class="object-cover object-top w-full h-full" alt="" srcset="">
                        <div id="wrapperSeriesGenre_"
                            class="absolute bottom-0 w-full h-full ease-in duration-100 group-hover:bg-opacity-50 "
                            style="transition: background-color 0.3s ease;">
                            <div
                                class="absolute text-sm bg-sky-500 text-white right-2 top-2 px-1 flex group-hover:hidden">
                                ongoing</div>
                            <div class="absolute bottom-2 group-hover:bottom-0 ease-in duration-100 text-white">
                                <p class="p-2 hidden group-hover:flex text-sm"
                                    x-text="sliceStr('Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste id ad voluptatem ipsa vero, perferendis dicta illum distinctio nemo et.', 150)">
                                </p>

                                <h1
                                    class="group-hover:bg-transparent font-comicBold p-2 bg-primary text-lg hidden sm:flex group-hover:flex">
                                    Boarding diary
                                </h1>
                            </div>
                        </div>
                        <div class="px-2 border-x border-b border-gray-400">
                            <div class="flex sm:hidden justify-between items-center">
                                <h1 class="group-hover:bg-transparent font-comicBold text-lg "
                                    x-text="sliceStr('Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste id ad voluptatem ipsa vero, perferendis dicta illum distinctio nemo et.', 9)">
                                </h1>
                                <p class="text-sm text-primary font-medium">Romance</p>
                            </div>
                            <span class="text-sm font-comicBold text-primary flex sm:hidden">Chapter 109</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
