<div>
    <div class="w-full min-h-screen" x-data="{
        scrollingElement: (document.scrollingElement || document.documentElement),
        speed: 2,
        isScrolling: false,
        scrollInterval: null,
        setStop: false,
        btnNav: true,
        chapterList: false,
    
        scrollToBottom() {
            const scrollAmount = 1;
            const scrollDuration = 500;
    
            const scroll = () => {
                this.scrollingElement.scrollTop += scrollAmount;
    
                // Periksa apakah sudah mencapai paling bawah
                if (this.scrollingElement.scrollTop + this.scrollingElement.clientHeight >= this.scrollingElement.scrollHeight) {
                    this.stopScroll();
                }
            };
    
            // Memastikan tidak ada interval yang aktif sebelum memulai
            this.stopScroll();
            // Memulai animasi scroll dengan interval berdasarkan kecepatan yang dipilih
            const startTime = performance.now();
            const animateScroll = (currentTime) => {
                if (this.scrollInterval !== null) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / scrollDuration, 1);
    
                    this.scrollingElement.scrollTop += scrollAmount * progress;
    
                    if (this.scrollingElement.scrollTop + this.scrollingElement.clientHeight < this.scrollingElement.scrollHeight) {
                        requestAnimationFrame(animateScroll);
                    } else {
                        this.stopScroll();
                    }
                } else {
    
                    this.stopScroll();
                }
            };
    
            this.scrollInterval = setInterval(scroll, 1000 / this.speed);
            requestAnimationFrame(animateScroll);
    
            this.isScrolling = true;
        },
    
        stopScroll() {
            // Menghentikan autoscroll dan membersihkan interval
            clearInterval(this.scrollInterval);
            this.scrollInterval = null
            this.isScrolling = false;
        },
        handleNavBtn() {
            setTimeout(() => {
                this.btnNav = !this.btnNav
            }, 1000)
        },
    
    }" x-init="$watch('btnNav', value => {
        if (value) {
            setTimeout(() => {
                btnNav = false;
            }, 8000)
        }
    })">
        <div class="fixed top-0 flex items-center justify-between border-b border-primary bg-white py-1 px-4 w-full"
            x-cloak x-show="btnNav" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 -translate-y-full" x-transition:enter-end="opacity-100 -translate-y-0"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="opacity-100 -translate-y-0" x-transition:leave-end="opacity-0 -translate-y-full">
            <div>
                <button type="button" @click="window.history.back()">
                    <x-icons.arrow default="45px" rotate="-rotate(180)" />
                </button>
            </div>
            <div>
                <h1 class="text-2xl font-comicBold">{{ $chapter->title }}</h1>
            </div>
            <div>

            </div>
        </div>
        <div class="max-w-3xl mx-auto flex justify-center">
            <div id="point" @click="handleNavBtn">
                @foreach ($chapter->contents as $content)
                    <div>
                        <img src="{{ $content->url }}" class="object-fill" alt="">
                    </div>
                @endforeach
            </div>
            <div class="fixed w-full left-0 flex space-x-1 justify-center bottom-5 " x-cloak x-show="btnNav"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-full" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-full">
                <button type="button"
                    class="border-2 border-gray-800 p-1 rounded-full bg-white flex items-center justify-center">
                    <x-icons.prev default="34px" color="#000000"></x-icons.prev>
                </button>
                <button x-show="!isScrolling" type="button" @click.stop="scrollToBottom"
                    class="border-2 border-gray-800 p-1 rounded-full bg-white flex items-center justify-end">
                    <x-icons.play default="30px" color="#000000" class="ml-1"></x-icons.play>
                </button>
                <button x-show="isScrolling" type="button" @click.stop="stopScroll"
                    class="border-2 border-gray-800 p-1 rounded-full bg-white flex items-center justify-end">
                    <x-icons.pause default="34px" color="#000000" class="ml-1"></x-icons.pause>
                </button>
                <button type="button"
                    class="border-2 border-gray-800 p-1 rounded-full bg-white flex items-center justify-center">
                    <x-icons.prev class="rotate-180" default="34px" color="#000000"></x-icons.prev>
                </button>
            </div>
        </div>
        <div x-cloak
            class="fixed max-w-[250px] p-2 w-full h-[80vh] bg-gray-100 bg-opacity-70 backdrop-blur-sm bottom-0 right-0 top-[10%] ease ease-in duration-100"
            :class="!chapterList ? 'translate-x-full' : ''">
            <button @click="chapterList = ! chapterList" type="button" :disabled="!btnNav && !chapterList && widthValue < 850"
                class="disabled:opacity-30 absolute w-16 h-44 bg-gray-100 backdrop-blur-sm bg-opacity-70 bottom-[35%] -left-16 rounded-l-md  border-l border-primary border-y ease-in duration-100" >
                <div class="h-full flex items-center">
                    <p class="text-sm font-comicBold transform rotate-90 w-16">{{ $chapter->title }}</p>
                </div>
            </button>
            <h1 class="text-xl text-center font-comicBold border-b-2 pb-2 border-gray-400">Daftar Chapter</h1>
            <div class="space-y-1 mt-5 w-full overflow-y-auto max-h-[70vh]">
                @foreach ($series->chapters as $chapterlist)
                    <div class="cursor-pointer hover:text-primary px-2 flex items-center justify-between">
                        <h4>{{ $chapterlist->title }}</h4>
                        @if ($chapterlist->id == $chapter->id)
                            <x-icons.check default="15px" />
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
