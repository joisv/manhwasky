<nav>
    <div class="hidden sm:fixed lg:flex sm:top-0 sm:right-0 px-6 py-2 text-end z-10 w-full justify-between items-center"
        :class="backdrop ? 'backdrop-blur-md' : ''">
        <div class="flex space-x-5 items-center ">
            @empty(!$setting->logo)
                <div class="w-36 h-14">
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="logo" class="w-full h-full object-cover">
                </div>
            @else
            <a href="{{ route('home') }}" wire:navigate>
                <h1 class="font-little text-4xl font-semibold "><span class="text-primary">Manhwa</span>Sky</h1>
            </a>
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
        :class="{ 'translate-x-full': !setNav, '': setNav }">
        <header class="flex items-center justify-between h-16 w-full ">
            <a href="{{ route('home') }}" wire:navigate>
                <h1 class="font-comicBold text-4xl"><span class="text-primary">Manhwa</span>Sky</h1>
            </a>
        </header>
        <button
            @click="() => {
            $dispatch('open-modal', 'search-modal');
            setNav = ! setNav;    
        }"
            class="w-full border border-gray-200 p-2 rounded-sm flex justify-between mb-3">
            <p class="text-gray-500">search</p>
            <x-icons.search default="24px" />
        </button>
        <div class="grid grid-cols-3 gap-x-1">
            @auth
                <div></div>
            @else
                <div>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" wire:navigate>
                            <div class="w-full border border-primary rounded-sm py-1 text-lg pl-2">regsiter</div>
                        </a>
                    @endif
                </div>
                <div class="col-span-2">
                    <a href="{{ route('login') }}" wire:navigate>
                        <div class="w-full bg-primary text-white py-1 rounded-sm text-lg pl-2">login</div>
                    </a>
                </div>
            @endauth
        </div>
        <ul class="mt-3">
            @auth
                <li class="border-b border-b-primary border-opacity-30 py-2">
                    <div class="flex items-center justify-between px-3">
                        <div class="flex items-center space-x-3">
                            {{-- <x-icons.bookshelf default="27px" active="rgb(156, 163, 175)" /> --}}
                            <p class="font-comicBold text-lg">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </li>
                <li class="border-b border-b-primary border-opacity-30 py-2 bg-gra">
                    <a href="{{ route('profile') }}" wire:navigate>
                        <div class="flex items-center justify-between px-3">
                            <div class="flex items-center space-x-3 ">
                                <svg width="26px" height="26px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM15 9C15 10.6569 13.6569 12 12 12C10.3431 12 9 10.6569 9 9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9ZM12 20.5C13.784 20.5 15.4397 19.9504 16.8069 19.0112C17.4108 18.5964 17.6688 17.8062 17.3178 17.1632C16.59 15.8303 15.0902 15 11.9999 15C8.90969 15 7.40997 15.8302 6.68214 17.1632C6.33105 17.8062 6.5891 18.5963 7.19296 19.0111C8.56018 19.9503 10.2159 20.5 12 20.5Z"
                                            fill="rgb(156, 163, 175)"></path>
                                    </g>
                                </svg>
                                <p class="font-comicRegular text-lg bg-gra">Profile</p>
                            </div>
                            @if (request()->routeIs('profile'))
                                <x-icons.check default="20px" />
                            @endif
                        </div>
                    </a>
                </li>
                @hasanyrole('admin|editor|demo')
                    <li class="border-b border-b-primary border-opacity-30 py-2 bg-gra">
                        <a href="{{ route('dashboard') }}" wire:navigate>
                            <div class="flex items-center justify-between px-3">
                                <div class="flex items-center space-x-3 ">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M3 4.6C3 4.03995 3 3.75992 3.10899 3.54601C3.20487 3.35785 3.35785 3.20487 3.54601 3.10899C3.75992 3 4.03995 3 4.6 3H13.4C13.9601 3 14.2401 3 14.454 3.10899C14.6422 3.20487 14.7951 3.35785 14.891 3.54601C15 3.75992 15 4.03995 15 4.6V5.4C15 5.96005 15 6.24008 14.891 6.45399C14.7951 6.64215 14.6422 6.79513 14.454 6.89101C14.2401 7 13.9601 7 13.4 7H4.6C4.03995 7 3.75992 7 3.54601 6.89101C3.35785 6.79513 3.20487 6.64215 3.10899 6.45399C3 6.24008 3 5.96005 3 5.4V4.6Z"
                                                stroke="rgb(156, 163, 175)" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M3 11.6C3 11.0399 3 10.7599 3.10899 10.546C3.20487 10.3578 3.35785 10.2049 3.54601 10.109C3.75992 10 4.03995 10 4.6 10H19.4C19.9601 10 20.2401 10 20.454 10.109C20.6422 10.2049 20.7951 10.3578 20.891 10.546C21 10.7599 21 11.0399 21 11.6V12.4C21 12.9601 21 13.2401 20.891 13.454C20.7951 13.6422 20.6422 13.7951 20.454 13.891C20.2401 14 19.9601 14 19.4 14H4.6C4.03995 14 3.75992 14 3.54601 13.891C3.35785 13.7951 3.20487 13.6422 3.10899 13.454C3 13.2401 3 12.9601 3 12.4V11.6Z"
                                                stroke="rgb(156, 163, 175)" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M3 18.6C3 18.0399 3 17.7599 3.10899 17.546C3.20487 17.3578 3.35785 17.2049 3.54601 17.109C3.75992 17 4.03995 17 4.6 17H9.4C9.96005 17 10.2401 17 10.454 17.109C10.6422 17.2049 10.7951 17.3578 10.891 17.546C11 17.7599 11 18.0399 11 18.6V19.4C11 19.9601 11 20.2401 10.891 20.454C10.7951 20.6422 10.6422 20.7951 10.454 20.891C10.2401 21 9.96005 21 9.4 21H4.6C4.03995 21 3.75992 21 3.54601 20.891C3.35785 20.7951 3.20487 20.6422 3.10899 20.454C3 20.2401 3 19.9601 3 19.4V18.6Z"
                                                stroke="rgb(156, 163, 175)" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                    <p class="font-comicRegular text-lg bg-gra">Admin panel</p>
                                </div>
                                @if (request()->routeIs('dashboard'))
                                    <x-icons.check default="20px" />
                                @endif
                            </div>
                        </a>
                    </li>
                @endhasanyrole
            @endauth
            <li class="border-b border-b-primary border-opacity-30 py-2">
                <a href="{{ route('home.genres') }}" wire:navigate>
                    <div class="flex items-center justify-between px-3">
                        <div class="flex items-center space-x-3">
                            <x-icons.bookshelf default="27px" active="rgb(156, 163, 175)" />
                            <p class="font-comicRegular text-lg">Genres</p>
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
                            <p class="font-comicRegular text-lg">Bookmarks</p>
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
                            <p class="font-comicRegular text-lg bg-gra">Categories</p>
                        </div>
                        @if (request()->routeIs('home.categories'))
                            <x-icons.check default="20px" />
                        @endif
                    </div>
                </a>
            </li>
            <li class="border-b border-b-primary border-opacity-30 py-2">
                <button type="button" @click="$dispatch('open-modal', 'get-coins')"
                    class="flex w-full items-center justify-between px-3">
                    <div class="flex items-center space-x-3 ">
                        <x-icons.coins default="24px" color="rgb(156, 163, 175)" />
                        <p class="font-comicRegular text-lg">Coins</p>
                    </div>
                    <p class="font-comicBold text-gray-500">{{ Auth::user()?->coins }}</p>
                </button>
            </li>
            @auth
                <li class="border-b border-b-primary border-opacity-30 py-2">
                    <button type="button" wire:click="logout" class="flex w-full items-center justify-between px-3">
                        <div class="flex items-center space-x-3 ">
                            <svg width="23px" height="23px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.2429 22 18.8286 22 16.0002 22H15.0002C12.1718 22 10.7576 22 9.87889 21.1213C9.11051 20.3529 9.01406 19.175 9.00195 17"
                                        stroke="rgb(220 38 38)" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path d="M15 12L2 12M2 12L5.5 9M2 12L5.5 15" stroke="rgb(220 38 38)"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            <p class="font-comicRegular text-lg text-red-600">Logout</p>
                        </div>
                    </button>
                </li>
            @endauth
        </ul>
        <button class="absolute bottom-4 right-0" @click="setNav = false">
            <x-icons.arrow color="#350B75" />
        </button>
    </div>
    <x-modal name="search-modal" :show="$errors->isNotEmpty()" :is_transparent="true" focusable>
        <livewire:welcome.mobile-search />
    </x-modal>
</nav>
