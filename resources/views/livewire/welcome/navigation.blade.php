<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-end z-10 w-full flex justify-between items-center" :class="backdrop ? 'backdrop-blur-md' : ''" x-data="{
    scrollValue: window.pageYOffset,
    backdrop: false,
    setSearchOpen: false,
    
    init(){
        window.addEventListener('scroll', () => {
           this.scrollValue = window.pageYOffset
        });
    }
}" x-init="$watch('scrollValue', value => {
    backdrop = value >= 100 ? true : false;
})">
    <div class="flex space-x-5 items-center" >
        <h1 class="font-little text-4xl font-semibold "><span class="text-primary">Doujin</span>Sky</h1>
        <div >
            <ul class="flex space-x-2 text-xl font-medium">
                <li class="hover:text-primary ease-in duration-100"><a href="">Genre</a></li>
                <li class="hover:text-primary ease-in duration-100"><a href="">Jadwal</a></li>
                <li class="hover:text-primary ease-in duration-100"><a href="">Populer</a></li>
            </ul>
        </div>
    </div>
    <div class="flex space-x-2 items-center">
        <button x-show="!setSearchOpen" @click="setSearchOpen = true">
            <x-icons.search default="24px"/>
        </button>
        <div  x-show="setSearchOpen">
            <x-search class="focus:ring-0 focus:border-primary p-0" @click.outside="setSearchOpen = false"/>
        </div>
        <div>
            @auth
            <a href="{{ url('/dashboard') }}"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                wire:navigate>Dashboard</a>
        @else
            <a href="{{ route('login') }}"
                class="font-medium p-1 rounded-sm px-4 bg-primary text-white text-base"
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
