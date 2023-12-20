<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>
<nav>
    <h1 x-init="console.log(setting)"></h1>
    <img :src="" alt="" srcset="">
    <div class="hidden sm:fixed lg:flex sm:top-0 sm:right-0 p-6 text-end z-10 w-full justify-between items-center"
        :class="backdrop ? 'backdrop-blur-md' : ''">
        <div class="flex space-x-5 items-center ">
            <h1 class="font-little text-4xl font-semibold "><span class="text-primary">Doujin</span>Sky</h1>
            <div>
                <ul class="flex space-x-2 text-lg font-comicBold text-gray-600">
                    <li
                        class="hover:text-primary ease-in duration-100  {{ request()->routeIs('home.genres') ? 'text-primary' : '' }}">
                        <a href="{{ route('home.categories') }}"><a href="{{ route('home.genres') }}"
                                wire:navigate>Genres</a></li>
                    <li
                        class="hover:text-primary ease-in duration-100 {{ request()->routeIs('home.categories') ? 'text-primary' : '' }}">
                        <a href="{{ route('home.categories') }}" wire:navigate>Categories</a></li>
                    <li
                        class="hover:text-primary ease-in duration-100 {{ request()->routeIs('bookmarks') ? 'text-primary' : '' }}">
                        <a href="{{ route('bookmarks') }}" wire:navigate>Bookmark</a></li>
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
                                @hasanyrole('admin|editor')
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
            <div>
                <button class="w-full border border-primary rounded-sm py-1 text-lg">regsiter</button>
            </div>
            <div class="col-span-2">
                <button class="w-full bg-primary text-white py-1 rounded-sm text-lg">login</button>
            </div>
        </div>
        <ul class="mt-3">
            <li class="border-b border-b-primary border-opacity-30 py-2 bg-gra">
                <div class="flex items-center justify-between px-3">
                    <div class="flex items-center space-x-3 ">
                        <x-icons.schedule default="25px" active="rgb(156, 163, 175)" />
                        <p class="font-comicBold text-lg bg-gra">Jadwal</p>
                    </div>
                    @if (request()->routeIs('/'))
                        <x-icons.check default="20px" />
                    @endif
                </div>
            </li>
            <li class="border-b border-b-primary border-opacity-30 py-2">
                <div class="flex items-center justify-between px-3">
                    <div class="flex items-center space-x-3">
                        <x-icons.bookshelf default="27px" active="rgb(156, 163, 175)" />
                        <p class="font-comicBold text-lg">Genre</p>
                    </div>
                    @if (request()->routeIs('/'))
                        <x-icons.check default="20px" />
                    @endif
                </div>

            </li>
            <li class="border-b border-b-primary border-opacity-30 py-2">
                <div class="flex items-center justify-between px-3">
                    <div class="flex items-center space-x-3 ">
                        <x-icons.star default="27px" active="rgb(156, 163, 175)" />
                        <p class="font-comicBold text-lg">Populer</p>
                    </div>
                    @if (request()->routeIs('/'))
                        <x-icons.check default="20px" />
                    @endif
                </div>
            </li>
        </ul>
        <button class="absolute bottom-0 right-0" @click="setNav = false">
            <x-icons.arrow color="#350B75" />
        </button>
    </div>
</nav>
