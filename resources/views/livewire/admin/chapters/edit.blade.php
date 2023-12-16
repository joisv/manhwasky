<div x-data="{
    selectShow: false,
    permadateEdit: false,
    flatpickrInstance: null,
    thumbnail: false,

    init() {
        this.dateStr = this.dateStr
        let flat = document.querySelector('#flatpickr_chapter_edit')
        this.flatpickrInstance = flatpickr(flat, {
            altInput: true,
            {{-- enableTime: true, --}}
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d',
            defaultDate: @js($created),
            onChange: (selectedDates, dateStr, instance) => {
                $wire.created = dateStr;
            }
        })
    },

    convertToCustomFormat(inputDate) {
        const parts = inputDate ? inputDate.split('-') : '';
        const monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        const monthName = monthNames[parseInt(parts[1], 10) - 1];
        const formattedDate = `${monthName} ${parts[2]}, ${parseInt(parts[0], 10)}`;
        return formattedDate;
    },

    removeImg(thumbnail){
        $wire.thumbnail = '';
        $wire.$refresh();
    }
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
                <div class="space-y-2 pb-2" :class="permadateEdit ? 'border-b border-gray-400' : ''" wire:ignore>
                    <div :class="!permadateEdit ? 'py-0 border-b border-b-gray-400' : ''">
                        <button type="button" @click="permadateEdit = ! permadateEdit"
                            class="flex space-x-4 gray  w-full py-2 cursor-pointer">
                            <div>
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                    class="ease-in duration-200" :class="permadateEdit ? 'rotate-180' : ''"
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
                                <x-input-label for="permadateEdit">permalink & tanggal</x-input-label>
                                <div  x-show="!permadateEdit">
                                    <div class="text-base font-medium text-gray-400 mt-1"
                                        x-text="convertToCustomFormat($wire.created)" >
                                    </div>
                                    <input type="text" disabled
                                        class="border-0 focus:border-0 p-0 text-base font-medium text-gray-400 outline-none"
                                        wire:model="slug">
                                </div>
                            </div>
                        </button>
                        {{-- <div class="text-base font-medium text-gray-400 mt-2" x-show="!permadateEdit">
                        </div> --}}
                    </div>
                    <div x-show="permadateEdit" x-collapse class="space-y-2">
                        {{-- slug --}}
                        <input type="text"
                            class="border-x-0 border-t-0 w-full placeholder:text-gray-400 border-b-2 border-b-gray-300 focus:ring-0 py-2 px-1 focus:border-t-0"
                            placeholder="permalink" id="permalink" wire:model="slug">

                        {{-- tanggal --}}
                        <input id="flatpickr_chapter_edit" wire:model="created" type="text" placeholder="YYYY-MM-DD"
                            class="border-x-0 border-t-0 w-full placeholder:text-gray-400 border-b-2 border-b-gray-300 focus:ring-0 py-2 px-1 focus:border-t-0" />
                    </div>
                </div>
                {{-- Thumbnail --}}
                <div class="space-y-2 pb-2" :class="thumbnail ? 'border-b border-gray-400' : ''">
                    <div class="pb-8" :class="!thumbnail ? ' border-b border-b-gray-400' : ''">
                        <button type="button" @click="thumbnail = ! thumbnail"
                            class="flex space-x-4 gray w-full py-2 cursor-pointer">
                            <div>
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                    class="ease-in duration-200" :class="thumbnail ? 'rotate-180' : ''"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                    </g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M15 11L12.2121 13.7879C12.095 13.905 11.905 13.905 11.7879 13.7879L9 11M7 21H17C19.2091 21 21 19.2091 21 17V7C21 4.79086 19.2091 3 17 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21Z"
                                            stroke="rgb(31, 41, 55)" stroke-width="2" stroke-linecap="round">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <div class="text-start w-full">
                                <x-input-label for="thumbnail">Thumbnail</x-input-label>
                                @error('thumbnail')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                @if ($thumbnail)
                                    <div class="max-w-[20%] relative">
                                        @if (Str::startsWith($thumbnail, 'http://') || Str::startsWith($thumbnail, 'https://'))
                                            <img src="{{ $thumbnail }}" alt="" srcset=""
                                                class="w-full h-14 sm:h-20 object-contain object-left">
                                        @else
                                            <img src="{{ asset('storage/' . $thumbnail) }}" alt=""
                                                srcset="" class="w-full h-14 sm:h-20 object-contain object-left">
                                        @endif
                                        <div @click="removeImg"
                                            class="absolute h-5 w-5 rounded-lg flex items-center justify-center -top-3 -right-3 sm:right-0 bg-gray-400 text-white hover:bg-rose-500">
                                            x</div>
                                    </div>
                                @endif
                            </div>
                        </button>
                        <div x-cloak x-show="thumbnail" x-collapse>
                            <x-primary-button type="button" x-data
                                wire:click.live="setImg">{{ $thumbnail ? 'change' : 'add' }}</x-primary-button>
                        </div>
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
    </form>
</div>
