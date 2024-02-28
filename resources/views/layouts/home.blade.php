<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('storage/' . $setting->favicon) }}" type="image/x-icon">
    {{ $seo ?? '' }}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
    widthValue: window.innerWidth,

    init() {
        window.addEventListener('scroll', () => {
            this.scrollValue = window.pageYOffset
        });
        window.addEventListener('resize', () => {
            this.widthValue = window.innerWidth
        });
    },

    sliceStr(str, slice) {
        if (str.length > slice) {
            let finalStr = str.substring(0, slice)
            return finalStr + '...'
        }
        return str
    },
    setHover(wrapper, hover, index) {
        const hoverTag = document.getElementById(wrapper + index)

        if (hoverTag) {
            hoverTag.style.backgroundColor = hover;
        }
    },

    removeHover(wrapper, hover, index) {
        const hoverTag = document.getElementById(wrapper + index)

        if (hoverTag) {
            hoverTag.style.removeProperty('background-color');
        }
    },
}" x-init="$watch('scrollValue', value => {
    backdrop = value >= 100 ? true : false;
})">
    @if (!request()->routeIs('chapter'))
        <livewire:welcome.navigation />
    @endif
    <main class="@if (!request()->is('chapter')) lg:mt-20 @endif" :class="setNav ? 'backdrop-blur-sm' : ''">
        {{ $slot }}
    </main>
    @if (!request()->routeIs('chapter'))
        <button type="button" class="p-2 bg-primary fixed bottom-3 right-3 flex lg:hidden z-50" @click="setNav = true"
            :class="setNav ? 'hidden' : ''">
            <x-icons.dotmenu default="25px" />
        </button>
    @endif
    <x-modal name="get-coins" maxWidth="sm" :show="$errors->isNotEmpty()">
        <livewire:coins-modal />
    </x-modal>
    <footer>
        <div class="w-full px-4 bottom-0 mt-44 py-5 space-y-2 border-t-2 border-t-gray-300 relative">
            <div class="w-full max-w-5xl mx-auto space-y-4">
                {{-- <span class=" w-full font-comicBold opacity-70">Copyright @ {{ config('app.name') }}. All right
                    reserved.</span> --}}
                    <div class="text-gray-600 text-2xl sm:text-3xl font-comicBold w-[70%] sm:w-[40%] uppercase">
                        <h4>Manhwa and manga: More than just words and pictures.</h4>
                        <div class="sm:mt-4 mt-0">
                            <p class="text-black text-lg">download now!!</p>
                            <div class="flex space-x-3">
                                <svg fill="#000000" width="30px" height="30px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>ionicons-v5_logos</title><path d="M48,59.49v393a4.33,4.33,0,0,0,7.37,3.07L260,256,55.37,56.42A4.33,4.33,0,0,0,48,59.49Z"></path><path d="M345.8,174,89.22,32.64l-.16-.09c-4.42-2.4-8.62,3.58-5,7.06L285.19,231.93Z"></path><path d="M84.08,472.39c-3.64,3.48.56,9.46,5,7.06l.16-.09L345.8,338l-60.61-57.95Z"></path><path d="M449.38,231l-71.65-39.46L310.36,256l67.37,64.43L449.38,281C468.87,270.23,468.87,241.77,449.38,231Z"></path></g></svg>
                                

                                <svg fill="#000000" width="30px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>appstore</title> <path d="M30.62 20.419c-0.239-0.321-0.573-0.559-0.96-0.672l-0.013-0.003c-0.165-0.047-0.357-0.079-0.555-0.088l-0.006-0c-0.21-0.012-0.419-0.011-0.629-0.011h-4.15l-5.485-9.768c-0.697 0.73-1.18 1.671-1.343 2.718l-0.004 0.029c-0.044 0.268-0.069 0.578-0.069 0.893 0 1.050 0.279 2.035 0.766 2.885l-0.015-0.028 6.591 11.738c0.105 0.187 0.209 0.374 0.324 0.554 0.107 0.172 0.224 0.32 0.355 0.456l-0.001-0.001c0.275 0.28 0.639 0.471 1.046 0.528l0.010 0.001c0.070 0.010 0.152 0.015 0.234 0.015 0.339 0 0.655-0.094 0.925-0.257l-0.008 0.005c0.349-0.211 0.618-0.523 0.771-0.894l0.005-0.012c0.090-0.215 0.142-0.466 0.142-0.728 0-0.169-0.022-0.334-0.062-0.49l0.003 0.014c-0.055-0.208-0.125-0.388-0.213-0.558l0.007 0.015c-0.094-0.193-0.2-0.379-0.305-0.565l-1.52-2.707h1.994c0.21 0 0.419 0.001 0.628-0.011 0.203-0.009 0.395-0.041 0.578-0.092l-0.018 0.004c0.4-0.117 0.735-0.355 0.97-0.671l0.003-0.005c0.235-0.316 0.376-0.714 0.376-1.144s-0.141-0.829-0.38-1.15l0.004 0.005zM4.894 24.175l-0.99 1.875c-0.102 0.194-0.205 0.387-0.298 0.588-0.079 0.161-0.148 0.349-0.197 0.544l-0.004 0.020c-0.037 0.149-0.058 0.32-0.058 0.495 0 0.272 0.051 0.533 0.144 0.772l-0.005-0.015c0.15 0.395 0.414 0.719 0.751 0.939l0.007 0.005c0.254 0.165 0.564 0.263 0.898 0.263 0.081 0 0.16-0.006 0.237-0.017l-0.009 0.001c0.412-0.063 0.769-0.262 1.031-0.549l0.001-0.001c0.127-0.139 0.242-0.294 0.339-0.46l0.007-0.013c0.113-0.188 0.214-0.382 0.317-0.576l1.436-2.72c-0.552-0.82-1.476-1.352-2.525-1.352-0.389 0-0.761 0.073-1.103 0.207l0.021-0.007zM12.012 19.648l7.636-13.792c0.105-0.189 0.21-0.377 0.305-0.573 0.081-0.157 0.151-0.34 0.201-0.531l0.004-0.019c0.038-0.145 0.059-0.311 0.059-0.483 0-0.266-0.052-0.519-0.147-0.751l0.005 0.013c-0.156-0.388-0.426-0.704-0.767-0.914l-0.008-0.005c-0.262-0.161-0.578-0.256-0.917-0.256-0.082 0-0.163 0.006-0.243 0.017l0.009-0.001c-0.417 0.059-0.782 0.253-1.055 0.535l-0 0.001c-0.13 0.136-0.247 0.287-0.347 0.449l-0.007 0.012c-0.115 0.183-0.219 0.372-0.324 0.561l-0.483 0.872-0.483-0.872c-0.105-0.189-0.208-0.379-0.323-0.561-0.107-0.174-0.224-0.325-0.355-0.462l0.001 0.001c-0.273-0.283-0.637-0.477-1.045-0.535l-0.010-0.001c-0.070-0.010-0.151-0.015-0.233-0.015-0.339 0-0.656 0.095-0.925 0.26l0.008-0.004c-0.349 0.215-0.619 0.531-0.771 0.906l-0.005 0.013c-0.090 0.219-0.142 0.472-0.142 0.738 0 0.171 0.022 0.338 0.062 0.496l-0.003-0.014c0.055 0.21 0.125 0.393 0.213 0.566l-0.007-0.016c0.094 0.195 0.2 0.384 0.305 0.573l1.56 2.817-6.076 10.975h-4.164c-0.209 0-0.419-0.001-0.628 0.012-0.203 0.009-0.395 0.041-0.578 0.094l0.018-0.004c-0.401 0.119-0.735 0.36-0.969 0.68l-0.004 0.005c-0.235 0.321-0.376 0.724-0.376 1.159s0.141 0.838 0.38 1.165l-0.004-0.006c0.237 0.325 0.571 0.566 0.959 0.681l0.013 0.003c0.165 0.048 0.357 0.080 0.554 0.089l0.006 0c0.209 0.012 0.419 0.011 0.628 0.011h16.367c0.045-0.093 0.087-0.205 0.121-0.321l0.004-0.016c0.078-0.243 0.123-0.523 0.123-0.813 0-1.487-1.185-2.698-2.662-2.74l-0.004-0z"></path> </g></svg>
                            </div>
                        </div>
                    </div>
                    <p class="font-comicRegular text-base w-[80%] sm:w-[60%] text-gray-500 hidden sm:flex">All the comics on this website are only
                        previews of the
                        original comics, there may be many language errors, character names, and story lines. For the original
                        version, please buy the comic if it's available in your city.</p>

                       
            </div>
            <img src="{{ asset('maskot-no-bg.png') }}" alt="" srcset="" class="sm:flex sm:w-60 md:w-80 absolute right-5 -top-24 hidden">
        </div>
    </footer>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</body>

</html>
