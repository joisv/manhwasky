<nav  class=""  >
    <div class="@if(request()->is('chapter')) hidden @else hidden sm:fixed lg:flex @endif  sm:top-0 sm:right-0 p-6 text-end z-10 w-full justify-between items-center"
        :class="backdrop ? 'backdrop-blur-md' : ''">
        <div class="flex space-x-5 items-center ">
            <h1 class="font-little text-4xl font-semibold "><span class="text-primary">Doujin</span>Sky</h1>
            <div>
                <ul class="flex space-x-2 text-xl font-medium">
                    <li class="hover:text-primary ease-in duration-100"><a href="">Genre</a></li>
                    <li class="hover:text-primary ease-in duration-100"><a href="">Jadwal</a></li>
                    <li class="hover:text-primary ease-in duration-100"><a href="">Populer</a></li>
                </ul>
            </div>
        </div>
        <div class="flex space-x-2 items-center">
            <button x-show="!setSearchOpen" @click="setSearchOpen = true">
                <x-icons.search default="24px" />
            </button>
            <div x-show="setSearchOpen">
                <x-search class="focus:ring-0 focus:border-primary p-0" @click.outside="setSearchOpen = false" />
            </div>
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        wire:navigate>Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-medium p-1 rounded-sm px-4 bg-primary text-white text-base"
                        wire:navigate>Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ms-2 font-medium p-1 rounded-sm px-4 bg-transparent border border-gray-600 text-base"
                            wire:navigate>Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <div x-cloak x-data class="flex flex-col lg:hidden w-full max-w-[400px] bg-white h-screen fixed z-50 p-2 right-0 ease-in duration-100" :class="!setNav ? 'translate-x-full' : ''">
        <header class="flex items-center justify-between h-16 w-full ">
            <h1 class="font-comicBold text-4xl"><span class="text-primary">Doujin</span>Sky</h1>
        </header>
        <ul class="space-y-1">
            <li class="border-b border-b-primary border-opacity-40 pb-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 ">
                        <x-icons.schedule default="25px" />
                        <p class="font-comicBold text-lg">Jadwal</p>
                    </div>
                    @if (request()->routeIs('/'))
                        <x-icons.check default="20px" />
                    @endif
                </div>
            </li>
            <li class="border-b border-b-primary border-opacity-40 pb-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <x-icons.bookshelf default="27px" />
                        <p class="font-comicBold text-lg">Genre</p>
                    </div>
                    @if (request()->routeIs('/'))
                        <x-icons.check default="20px" />
                    @endif
                </div>
                
            </li>
            <li class="border-b border-b-primary border-opacity-40 pb-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 ">
                        <x-icons.star default="27px" />
                        <p class="font-comicBold text-lg">Populer</p>
                    </div>
                    @if (request()->routeIs('/'))
                        <x-icons.check default="20px" />
                    @endif
                </div>
            </li>
        </ul>
        <button class="absolute bottom-0 right-0" @click="setNav = false">
            <x-icons.arrow color="#350B75"/>
        </button>
    </div>
</nav>
