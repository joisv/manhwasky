<nav>
    <div class="hidden sm:fixed lg:flex sm:top-0 sm:right-0 px-6 py-2 text-end z-10 w-full justify-between items-center"
        :class="backdrop ? 'backdrop-blur-md' : ''">
        <div class="flex space-x-5 items-center ">
            @empty(!$setting->logo)
                <div class="w-36 h-14">
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="logo" class="w-full h-full object-cover">
                </div>
            @else
                <h1 class="font-little text-4xl font-semibold "><span class="text-primary">Doujin</span>Sky</h1>
            @endempty
            <div>
                <ul class="flex space-x-2 text-lg font-comicBold text-gray-600">
                    <li
                        class="hover:text-primary ease-in duration-100  {{ request()->routeIs('home.genres') ? 'text-primary' : '' }}">
                        <a href="{{ route('home.categories') }}"><a href="{{ route('home.genres') }}"
                                wire:navigate>Genres</a>
                    </li>
                    <li
                        class="hover:text-primary ease-in duration-100 {{ request()->routeIs('home.categories') ? 'text-primary' : '' }}">
                        <a href="{{ route('home.categories') }}" wire:navigate>Categories</a>
                    </li>
                    <li
                        class="hover:text-primary ease-in duration-100 {{ request()->routeIs('bookmarks') ? 'text-primary' : '' }}">
                        <a href="{{ route('bookmarks') }}" wire:navigate>Bookmark</a>
                    </li>
                    <li
                        class="hover:text-primary ease-in duration-100 {{ request()->routeIs('bookmarks') ? 'text-primary' : '' }}">
                        <button type="button" @click="$dispatch('open-modal', 'get-coins')">Coins</button>
                    </li>
                    {{-- <livewire:get-coins-button /> --}}
                </ul>
            </div>
        </div>
        <div class="flex space-x-2 items-center">
            <button x-cloak x-show="!setSearchOpen" @click="setSearchOpen = true">
                <x-icons.search default="24px" />
            </button>
            <livewire:welcome.search />
            <div>
                @auth
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 font-comicBold border border-transparent text-base leading-4 rounded-md dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name"
                                        x-on:profile-updated.window="name = $event.detail.name"></div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile')" wire:navigate>
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                @auth
                                    <button type="button" @click="$dispatch('open-modal', 'get-coins')"
                                        class="text-sm text-gray-700 w-full text-start px-4 py-2 hover:bg-gray-200">
                                        Coins {{ Auth::user()?->coins }}
                                    </button>
                                @endauth
                                @hasanyrole('admin|editor|demo')
                                    <x-dropdown-link :href="route('dashboard')" wire:navigate>
                                        {{ __('Admin panel') }}
                                    </x-dropdown-link>
                                @endhasanyrole
                                <!-- Authentication -->
                                <button wire:click="logout" class="w-full text-start">
                                    <x-dropdown-link>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </button>
                            </x-slot>
                        </x-dropdown>
                    </div>
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
    <div x-cloak x-data
        class="flex flex-col lg:hidden w-full max-w-[300px] bg-white h-screen fixed z-50 p-2 right-0 ease-in duration-100"
        :class="!setNav ? 'translate-x-full' : ''">
        <header class="flex items-center justify-between h-16 w-full ">
            <h1 class="font-comicBold text-4xl"><span class="text-primary">Doujin</span>Sky</h1>
        </header>
        <div class="grid grid-cols-3 gap-x-1">
            @auth
                <div></div>
            @else
                <div>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" wire:navigate>
                            <div class="w-full border border-primary rounded-sm py-1 text-lg">regsiter</div>
                        </a>
                    @endif
                </div>
                <div class="col-span-2">
                    <a href="{{ route('login') }}" wire:navigate>
                        <div class="w-full bg-primary text-white py-1 rounded-sm text-lg">login</div>
                    </a>
                </div>
            @endauth
        </div>
        <ul class="mt-3">
            <li class="border-b border-b-primary border-opacity-30 py-2">
                <a href="{{ route('home.genres') }}" wire:navigate>
                    <div class="flex items-center justify-between px-3">
                        <div class="flex items-center space-x-3">
                            <x-icons.bookshelf default="27px" active="rgb(156, 163, 175)" />
                            <p class="font-comicBold text-lg">Genres</p>
                        </div>
                        @if (request()->routeIs('home.genres'))
                            <x-icons.check default="20px" />
                        @endif
                    </div>
                </a>
            </li>
            <li class="border-b border-b-primary border-opacity-30 py-2 bg-gra">
                <a href="{{ route('bookmarks') }}" wire:navigate>
                    <div class="flex items-center justify-between px-3">
                        <div class="flex items-center space-x-3 ">
                            <x-icons.bookmark default="30px" color="rgb(156, 163, 175)" />
                            <p class="font-comicBold text-lg bg-gra">Bookmarks</p>
                        </div>
                        @if (request()->routeIs('bookmarks'))
                            <x-icons.check default="20px" />
                        @endif
                    </div>
                </a>
            </li>    
            <li class="border-b border-b-primary border-opacity-30 py-2 bg-gra">
                <a href="{{ route('home.categories') }}" wire:navigate>
                    <div class="flex items-center justify-between px-3">
                        <div class="flex items-center space-x-3 ">
                            <x-icons.schedule default="25px" active="rgb(156, 163, 175)" />
                            <p class="font-comicBold text-lg bg-gra">Categories</p>
                        </div>
                        @if (request()->routeIs('home.categories'))
                            <x-icons.check default="20px" />
                        @endif
                    </div>
                </a>
            </li>
            <li class="border-b border-b-primary border-opacity-30 py-2">
                <button type="button" @click="$dispatch('open-modal', 'get-coins')" class="flex w-full items-center justify-between px-3">
                    <div class="flex items-center space-x-3 ">
                            <x-icons.coins default="24px" color="rgb(156, 163, 175)" />
                            <p class="font-comicBold text-lg">Coins</p>
                    </div>
                    <p class="font-comicBold text-gray-500">{{ Auth::user()?->coins }}</p>
                </button>
            </li>
        </ul>
        <button class="absolute bottom-0 right-0" @click="setNav = false">
            <x-icons.arrow color="#350B75" />
        </button>
    </div>
</nav>
