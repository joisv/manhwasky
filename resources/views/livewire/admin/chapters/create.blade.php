@php
    if ($isEdit) {
        $finalValue = \Carbon\Carbon::createFromFormat('Y-m-d', $created);
        if ($finalValue !== false) {
            $inicialDate = $finalValue->format('F j, Y');
        }
    } else {
        $inicialDate = $created->format('F j, Y');
    }
@endphp
<div x-data="{
    selectShow: false,
    permadate: false,
    dateInit: @js($inicialDate),
    flat: null,

    init() {
        let flat = document.querySelector('#flatpickr_chapter')
        this.flatpickrInstance = flatpickr(flat, {
            altInput: true,
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d',
            defaultDate: @js($created),
            onChange: (selectedDates, dateStr, instance) => {
                $wire.created = dateStr;
                this.dateInit = this.convertToCustomFormat(dateStr)
            }
        })
    },

    convertToCustomFormat(inputDate) {
        const parts = inputDate.split('-');
        const monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        const monthName = monthNames[parseInt(parts[1], 10) - 1];
        const formattedDate = `${monthName} ${parts[2]}, ${parseInt(parts[0], 10)}`;
        return formattedDate;
    },

}" @close-modal="show = false">
    <form wire:submit="save">
        <div class="p-3 min-h-[45vh] space-y-3">
            <header class="flex justify-between items-center">
                <h1 class="text-lg font-semibold">Menambahkan Chapter</h1>
                <x-primary-button type="submit" class="disabled:bg-gray-600" wire:loading.attr="disabled">
                    <div class="flex items-center space-x-1 w-full">
                        <x-icons.loading wire:loading />
                        <h2>
                            Save
                        </h2>
                    </div>
                </x-primary-button>
            </header>
            <div class="space-y-1">
                <livewire:admin.chapters.set-series />
                <div class="space-x-1">
                    <x-input-label for="title">Title</x-input-label>
                    <input type="text"
                        class="border-x-0 border-t-0 w-full placeholder:text-gray-400 border-b-2 border-b-gray-300 focus:ring-0 py-2 px-1 focus:border-t-0"
                        placeholder="title" id="title" wire:model="title" x-on:blur="$dispatch('setslug')"
                        x-on:focus="selectShow = false">
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Permalink dan tanggal --}}
                <div class="space-y-2 pb-2" :class="permadate ? 'border-b border-gray-400' : ''" wire:ignore>
                    <div :class="!permadate ? 'py-0 border-b border-b-gray-400' : ''">
                        <button type="button" @click="permadate = ! permadate"
                            class="flex space-x-4 gray  w-full py-2 cursor-pointer">
                            <div>
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                    class="ease-in duration-200" :class="permadate ? 'rotate-180' : ''"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M15 11L12.2121 13.7879C12.095 13.905 11.905 13.905 11.7879 13.7879L9 11M7 21H17C19.2091 21 21 19.2091 21 17V7C21 4.79086 19.2091 3 17 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21Z"
                                            stroke="rgb(31, 41, 55)" stroke-width="2" stroke-linecap="round"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="text-start">
                                <x-input-label for="permadate">permalink & tanggal</x-input-label>
                                <div class="text-base font-medium text-gray-400 mt-1" x-show="!permadate"
                                    x-text="dateInit">
                                </div>
                                <input type="text" disabled
                                    class="border-0 focus:border-0 p-0 text-base font-medium text-gray-400 outline-none"
                                    wire:model="slug">
                            </div>
                        </button>
                        {{-- <div class="text-base font-medium text-gray-400 mt-2" x-show="!permadate">
                        </div> --}}
                    </div>
                    <div x-show="permadate" x-collapse class="space-y-2">
                        {{-- slug --}}
                        <input type="text"
                            class="border-x-0 border-t-0 w-full placeholder:text-gray-400 border-b-2 border-b-gray-300 focus:ring-0 py-2 px-1 focus:border-t-0"
                            placeholder="permalink" id="permalink" wire:model="slug">

                        {{-- tanggal --}}
                        <input id="flatpickr_chapter" wire:model="created" type="text" placeholder="YYYY-MM-DD"
                            class="border-x-0 border-t-0 w-full placeholder:text-gray-400 border-b-2 border-b-gray-300 focus:ring-0 py-2 px-1 focus:border-t-0" />
                    </div>
                </div>
                <div class="space-y-1">
                    <x-input-label for="chapterStr">Chapter</x-input-label>
                    <textarea id="chapterStr" rows="4"
                        class="block p-2.5 w-full min-h-[40vh] text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Chapter url, pisahkan dengan koma (http://foo.huh/baz.wepb, etc..)" wire:model="chapterStr"
                        x-on:focus="selectShow = false"></textarea>
                    @error('chapterStr')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        {{-- <div class="absolute w-20 h-20 bg-red-500 right-0 top-0"></div> --}}
    </form>
</div>
