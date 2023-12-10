<x-home-layout>
        @if (Route::has('login'))
            <livewire:welcome.navigation />
        @endif

        <div
            class="h-[45vh] sm:h-[50vh] md:h-[60vh] lg:h-[80vh] w-full relative overflow-visible mb-4 bg-[url('https://pbs.twimg.com/media/E-K3UTCVIAkIgvF.png')] bg-cover bg-no-repeat">
            <div class="backdrop-blur-md w-full h-full bg-gray-900 bg-opacity-40 flex items-center ">
                {{-- slide --}}
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="sm:w-[90%] w-full h-[60%] mx-auto bg-blue-500 flex justify-center sm:flex-col">
                                <img src="http://manhwa.test/Screenshot_2023-12-09_211342-ai-brush-removebg-edtxo3d.png"
                                    class=" object-fill object-bottom absolute min-[300px]:w-[80vw] min-[420px]:w-[65vw] min-[500px]:w-[50vw] sm:w-[45vw] md:w-[40vw] bottom-0"
                                    alt="" srcset="">
                                <div
                                    class="w-full h-full flex items-end px-2 sm:px-20 justify-center text-center sm:justify-end z-50 sm:text-start relative sm:items-center">
                                    <article class="w-1/2 absolute -bottom-10 lg:bottom-1/4">
                                        <h1
                                            class="sm:text-white text-2xl sm:text-3xl md:text-5xl font-bold sm:font-semibold text-black">
                                            Boarding diary</h1>
                                        <p class="text-gray-100 font-medium text-base sm:text-lg hidden sm:flex">
                                            Jun-woo,
                                            seorang mahasiswa baru, menginap di rumah teman dekat sekolah. Saat dirawat
                                            oleh
                                            Mikyung</p>
                                        <button type="button"
                                            class="py-1 px-2 text-sm sm:text-lg bg-yellow-500 text-black font-semibold sm:mt-5 mt-1 focus:ring-1 focus:ring-yellow-600">Mulai
                                            membaca</button>
                                    </article>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-1.jpg" class="opacity-30" />
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-2.jpg" class="opacity-30" />
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </div>
        <div class="max-w-5xl bg-primary h-20 mx-auto"></div>
        <div class="grid sm:grid-cols-4  gap-3 max-w-5xl mx-auto mt-3 p-1 sm:p-2">
            <div class="w-full h-32 sm:h-44 ">
                <img src="https://okto.uwakjawa.xyz/storage/drive/W8W7v3Trg0Rkh8p5mZOASYhybjJ0ks/qR6ZVfGY1UAqpf6jMvRZ0ZYvtQyIyk.jpg"
                    class="object-cover object-top hover:blur-sm ease-in duration-100 w-full h-full" alt=""
                    srcset="">
            </div>
            <div class="w-full h-32 sm:h-44 ">
                <img src="https://okto.uwakjawa.xyz/storage/drive/W8W7v3Trg0Rkh8p5mZOASYhybjJ0ks/qR6ZVfGY1UAqpf6jMvRZ0ZYvtQyIyk.jpg"
                    class="object-cover object-top hover:blur-sm ease-in duration-100 w-full h-full" alt=""
                    srcset="">
            </div>
            <div class="w-full h-32 sm:h-44 ">
                <img src="https://okto.uwakjawa.xyz/storage/drive/W8W7v3Trg0Rkh8p5mZOASYhybjJ0ks/qR6ZVfGY1UAqpf6jMvRZ0ZYvtQyIyk.jpg"
                    class="object-cover object-top hover:blur-sm ease-in duration-100 w-full h-full" alt=""
                    srcset="">
            </div>
            <div class="w-full h-32 sm:h-44 ">
                <img src="https://okto.uwakjawa.xyz/storage/drive/W8W7v3Trg0Rkh8p5mZOASYhybjJ0ks/qR6ZVfGY1UAqpf6jMvRZ0ZYvtQyIyk.jpg"
                    class="object-cover object-top hover:blur-sm ease-in duration-100 w-full h-full" alt=""
                    srcset="">
            </div>
            <div class="w-full h-32 sm:h-44  col-span-2">
                <img src="https://okto.uwakjawa.xyz/storage/drive/W8W7v3Trg0Rkh8p5mZOASYhybjJ0ks/qR6ZVfGY1UAqpf6jMvRZ0ZYvtQyIyk.jpg"
                    class="object-cover object-top hover:blur-sm ease-in duration-100 w-full h-full" alt=""
                    srcset="">
            </div>
            <div class="w-full h-32 sm:h-44 ">
                <img src="https://okto.uwakjawa.xyz/storage/drive/W8W7v3Trg0Rkh8p5mZOASYhybjJ0ks/qR6ZVfGY1UAqpf6jMvRZ0ZYvtQyIyk.jpg"
                    class="object-cover object-top hover:blur-sm ease-in duration-100 w-full h-full" alt=""
                    srcset="">
            </div>
            <div class="w-full h-32 sm:h-44 ">
                <img src="https://okto.uwakjawa.xyz/storage/drive/W8W7v3Trg0Rkh8p5mZOASYhybjJ0ks/qR6ZVfGY1UAqpf6jMvRZ0ZYvtQyIyk.jpg"
                    class="object-cover object-top hover:blur-sm ease-in duration-100 w-full h-full" alt=""
                    srcset="">
            </div>
        </div>
        <script>
            var swiper = new Swiper(".mySwiper", {
                spaceBetween: 30,
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
</x-home-layout>
