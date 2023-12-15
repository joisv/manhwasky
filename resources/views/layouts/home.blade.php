<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script> --}}
    <!-- Scripts -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-comicRegular relative" x-data="{
    setNav: false,
    scrollValue: window.pageYOffset,
    backdrop: false,
    setSearchOpen: false,
    
    init() {
        window.addEventListener('scroll', () => {
            this.scrollValue = window.pageYOffset
        });
    },
    
    sliceStr(str, slice) {
        if (str.length > slice) {
            let finalStr = str.substring(0, slice)
            return finalStr + '...'
        }
        return str
    }
}" x-init="$watch('scrollValue', value => {
    backdrop = value >= 100 ? true : false;
})">
    <livewire:welcome.navigation />
    <main class="@if (!request()->is('chapter')) lg:mt-20 @endif" :class="setNav ? 'backdrop-blur-sm' : ''">
        {{ $slot }}
    </main>
    <button type="button" class="p-2 bg-primary fixed bottom-3 right-3 flex lg:hidden" @click="setNav = true">
        <x-icons.dotmenu default="25px" />
    </button>
    <footer>
        <div class="w-full px-4 static bottom-0 mt-10 py-5 space-y-2 bg-gray-100">
            <div class="w-full text-center">
                <h1 class="font-comicBold text-4xl"><span class="text-primary">Doujin</span>Sky</h1>
                <span class=" w-full">Copyright @ {{ config('app.name') }}. All right reserved.</span>
            </div>
            <p class="font-comicBold text-base text-center max-w-5xl mx-auto">All the comics on this website are only
                previews of the
                original comics, there may be many language errors, character names, and story lines. For the original
                version, please buy the comic if it's available in your city.</p>
        </div>
    </footer>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</body>

</html>
