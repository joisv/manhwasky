<div class="space-y-2 pb-2" :class="coins ? 'border-b border-gray-400' : ''" x-data="{
    coins: true,
}">
    <div :class="!coins ? 'border-b border-b-gray-400' : ''">
        <button type="button" @click="coins = ! coins" class="flex space-x-4 gray  w-full py-2 cursor-pointer">
            <div>
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" class="ease-in duration-200"
                    :class="coins ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M15 11L12.2121 13.7879C12.095 13.905 11.905 13.905 11.7879 13.7879L9 11M7 21H17C19.2091 21 21 19.2091 21 17V7C21 4.79086 19.2091 3 17 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21Z"
                            stroke="rgb(31, 41, 55)" stroke-width="2" stroke-linecap="round"></path>
                    </g>
                </svg>
            </div>
            <x-input-label for="coins">Coins</x-input-label>
        </button>
        {{-- <div class="text-base font-medium text-gray-400 mt-2" x-show="!coins">
        </div> --}}
    </div>
    <div x-show="coins" x-collapse>
        <div>
            <div class="flex items-center">
                <input id="coin_free" type="radio" value="1" name="coin_free"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    wire:model.live.debounce.500ms="is_free">
                <label for="coin_free" class="ms-2 text-base font-medium text-gray-800  dark:text-gray-300">Free</label>
            </div>
            <div class="flex items-center">
                <input id="coin" type="radio" value="0" name="coin"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    wire:model.live.debounce.500ms="is_free">
                <label for="coin" class="ms-2 text-base font-medium text-gray-800  dark:text-gray-300">Coin</label>
            </div>
        </div>
        @if (!$is_free)
            <div>
                <input type="number" placeholder="Cari berdasarkan nama"
                    class="border-0 focus:ring-0 outline-none w-full p-0" wire:model.live.debounce.500ms="price">
            </div>
        @endif
    </div>
</div>
