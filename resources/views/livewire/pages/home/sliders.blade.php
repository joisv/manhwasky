<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        @forelse ($sliders as $slider)
            <div class="swiper-slide flex items-center ">
                <div class="w-[90%] h-[40%] sm:h-[60%] mx-auto flex justify-between items-end bg-cover">
                    <img src="{{ asset('storage/' . $slider->main) }}"
                        class=" object-fill object-bottom absolute min-[300px]:w-[70vw] min-[420px]:w-[65vw] min-[500px]:w-[50vw] sm:w-[45vw] md:w-[40vw] bottom-0 left-0"
                        alt="" srcset="">
                    <div
                        class="w-full h-full flex items-end px-2 sm:px-20 text-start justify-end z-50 relative sm:items-center">
                        <article class="w-1/2 absolute sm:right-4">
                            <h1
                                class="text-white text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold sm:font-semibold ">
                                {{ Str::limit($slider->title, 30, '...') }}</h1>
                            <p class="text-gray-100 font-medium md:text-xl hidden sm:flex"
                                x-text="sliceStr('{{ $slider->description }}', 150)"></p>
                            <p class="text-gray-100 font-medium text-sm sm:hidden flex"
                                x-text="sliceStr('{{ $slider->description }}', 50)"></p>
                            <a href="{{ $slider->url }}">
                                <div
                                    class="w-fit py-1 px-2 text-sm sm:text-lg bg-yellow-500 text-black font-semibold sm:mt-5 mt-1 focus:ring-1 focus:ring-yellow-600">
                                    Mulai
                                    membaca</div>
                            </a>
                        </article>
                    </div>
                </div>
            </div>
        @empty
            <span>tidak ada slider</span>
        @endforelse
    </div>
    {{-- <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div> --}}
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
</div>
