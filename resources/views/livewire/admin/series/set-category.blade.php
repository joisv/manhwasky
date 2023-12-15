{{-- genre --}}
<div class="space-y-2 pb-2" :class="category ? 'border-b border-gray-400' : ''" x-data="{
    category: false,
}">
    <div :class="!category ? 'border-b border-b-gray-400' : ''">
        <button type="button" @click="category = ! category" class="flex space-x-4 gray  w-full py-2 cursor-pointer">
            <div>
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" class="ease-in duration-200"
                    :class="category ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M15 11L12.2121 13.7879C12.095 13.905 11.905 13.905 11.7879 13.7879L9 11M7 21H17C19.2091 21 21 19.2091 21 17V7C21 4.79086 19.2091 3 17 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21Z"
                            stroke="rgb(31, 41, 55)" stroke-width="2" stroke-linecap="round"></path>
                    </g>
                </svg>
            </div>
            <x-input-label for="category">Category</x-input-label>
        </button>
        {{-- <div class="text-base font-medium text-gray-400 mt-2" x-show="!category">
        </div> --}}
    </div>
    <div x-show="category" x-collapse>
        <div
            class="border-x-0 border-t-0 w-full placeholder:text-gray-400 border-b-2 border-b-gray-300 focus:ring-0 focus:border-t-0">
            <div class="flex flex-wrap space-x-1 items-end w-full">
                <div class="gap-1 flex flex-wrap flex-1 items-center ">
                    @foreach ($selectedCategory as $selected)
                        <button type="button" wire:click="restoreCategory({{ $selected['id'] }})"
                            class="bg-blue-500 w-fit px-2 py-0 text-white text-base font-semibold text-start">{{ $selected['name'] }}</button>
                    @endforeach
                </div>
                <input type="text" placeholder="Cari berdasarkan nama"
                    class="border-0 focus:ring-0 outline-none w-full p-0" wire:model.live.debounce.200ms="searchCategory">
            </div>
        </div>
        <div class="w-full h-32 overflow-y-auto ">
            <div class="w-full">
                @forelse ($categories as $index => $category)
                    <div id="category-{{ $index }}"
                        class=" border-b border-b-gray-300 w-full flex items-center justify-between space-x-2">
                        <button type="button"
                            wire:click="setSelectedCategory({{ $category->id }}, '{{ $category->name }}')"
                            class="w-full text-start p-1 hover:bg-gray-200 ease-in duration-150">{{ $category->name }}</button>
                        <button type="button"
                            class="w-fit bg-gray-300 px-1 h-fit hover:bg-rose-400 hover:text-gray-200 ease-in duration-150 text-sm font-medium"
                            @click="removeCategory({{ $index }})">x</button>
                    </div>
                @empty
                    <div class="text-base font-medium w-full text-center">genre tidak
                        ada/ditemukan</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
