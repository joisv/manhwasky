<div x-data="{
    tag: false,
    genre: true,
    permalink: false,
    poster: false,
    status: false,
    inputTag: '',
    dataTag: $persist([]),
    tagSearchResult: [],
    seriesSetting: $persist(false),
    category: false,

    init() {},

    setInputTag(e) {
        let inputArray = this.inputTag.split(', ');
        inputArray = inputArray.filter(item => item.trim() !== '');
        let lastValue = inputArray[inputArray.length - 1];

        if (e.key === ' ' || e.key === 'Spacebar' || e.code === 'Space') {
            this.tagSearchResult = this.dataTag.filter(item => !inputArray.includes(item))
        } else {
            if (inputArray.length > 0) {
                this.tagSearchResult = this.dataTag.filter(item => item.includes(lastValue));
            } else {
                this.tagSearchResult = this.dataTag
            }
        }

        if (e.key === ',' || e.code === 'Comma' || e.which === 188) {
            inputArray.forEach(item => {
                let cleanItem = item.replace(/,/g, '');
                if (!this.dataTag.includes(cleanItem.trim())) {
                    this.dataTag.push(cleanItem.trim());
                }
            });
        }
    },

    removeTag(tagToRemove, index) {
        let elementToRemove = document.getElementById('tag-' + index);

        if (elementToRemove) {
            elementToRemove.parentNode.removeChild(elementToRemove);
        }
        let tag = this.dataTag.filter(t => t !== tagToRemove)
        this.dataTag = tag
    },

    addTag(tag, index) {
        let inputArray = this.inputTag.split(', ');
        let newArr = inputArray.filter(i => i !== inputArray[inputArray.length - 1])
        newArr.push(tag)
        let newTag = newArr.join(', ')

        this.inputTag = newTag + ', '
        let elementToRemove = document.getElementById('tag-' + index);

        if (elementToRemove) {
            elementToRemove.parentNode.removeChild(elementToRemove);
        }
        $wire.tag = this.inputTag;
    },

    toggleSetting() {
        this.seriesSetting = !this.seriesSetting;
    },
    removeGenre(id) {
        let elementToRemove = document.getElementById('genre-' + id);

        if (elementToRemove) {
            elementToRemove.parentNode.removeChild(elementToRemove);
        }
    }
}" x-init="tagSearchResult = dataTag" class="relative">
    <form wire:submit="save">
        <x-primary-button type="submit" class="disabled:bg-gray-600" wire:loading.attr="disabled">
            <div class="flex items-center space-x-1 w-full">
                <x-icons.loading wire:loading />
                <h2>
                    Save
                </h2>
            </div>
        </x-primary-button>
        <button type="button" class="absolute -top-16 -right-5 sm:-right-12 lg:hidden flex bg-blue-500 w-10 sm:w-20 p-1"
            @click="toggleSetting">
            <x-icons.setting />
        </button>
        <div class="flex w-full space-x-2">
            <div class="w-full space-y-3">
                <div class="flex items-center space-x-3">
                    <div class="w-4/5">
                        <input type="text"
                            class="border-x-0 border-t-0 w-full placeholder:text-gray-400 border-b-2 border-b-gray-300 focus:ring-0 py-2 px-1 focus:border-t-0"
                            placeholder="title" id="title" wire:model="title" x-on:blur="$dispatch('setslug')">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-[20%]">
                        <input type="text"
                            class="border-x-0 border-t-0 w-full placeholder:text-gray-400 border-b-2 border-b-gray-300 focus:ring-0 py-2 px-1 focus:border-t-0"
                            placeholder="Original title" id="original_title" wire:model="original_title">
                        @error('original_title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="h-full">
                    <textarea id="message" rows="4"
                        class="block p-2.5 w-full min-h-[40vh] text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Overview ...." wire:model="overview"></textarea>
                    @error('overview')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- Setting series --}}
            <div id="series_setting" :class="!seriesSetting ? 'translate-x-full' : ''"
                class="fixed lg:translate-x-0 right-0 w-full sm:w-[35vw] lg:w-[24vw] xl:w-[23vw] bg-white p-5 rounded-sm top-20 h-[85vh] space-y-4 overflow-y-auto ease-in duration-100">
                <div class="flex items-center space-x-2">
                    <button type="button" class="z-50 lg:hidden flex " @click="toggleSetting">
                        <x-icons.setting default="#000000" />
                    </button>
                    <h1
                        class="text-base font-semibold text-gray-700 hover:text-blue-700 ease-in duration-100 cursor-pointer">
                        Setelan Series</h1>
                </div>
                {{-- category --}}
                <livewire:admin.series.set-category />
                @error('category_id')
                    <span class="error">{{ $message }}</span>
                @enderror
                {{-- genre --}}
                <div class="space-y-2 pb-2" :class="genre ? 'border-b border-gray-400' : ''">
                    <div :class="!genre ? 'border-b border-b-gray-400' : ''">
                        <button type="button" @click="genre = ! genre"
                            class="flex space-x-4 gray  w-full py-2 cursor-pointer">
                            <div>
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                    class="ease-in duration-200" :class="genre ? 'rotate-180' : ''"
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
                            <x-input-label for="genre">Genre</x-input-label>
                        </button>
                        {{-- <div class="text-base font-medium text-gray-400 mt-2" x-show="!genre">
                        </div> --}}
                    </div>
                    <div x-show="genre" x-collapse>
                        <div
                            class="border-x-0 border-t-0 w-full placeholder:text-gray-400 border-b-2 border-b-gray-300 focus:ring-0 focus:border-t-0">
                            <div class="flex flex-wrap space-x-1 items-end w-full">
                                <div class="gap-1 flex flex-wrap flex-1 items-center ">
                                    @foreach ($selectedGenres as $selectedGenre)
                                        <button type="button" wire:click="restoreGenre({{ $selectedGenre['id'] }})"
                                            class="bg-blue-500 w-fit px-2 py-0 text-white text-base font-semibold text-start">{{ $selectedGenre['name'] }}</button>
                                    @endforeach
                                </div>
                                <input type="text" placeholder="Cari berdasarkan nama"
                                    class="border-0 focus:ring-0 outline-none w-full p-0"
                                    wire:model.live.debounce.200ms="searchGenre">
                            </div>
                        </div>
                        <div class="w-full h-32 overflow-y-auto ">
                            <div class="w-full">
                                @forelse ($genres as $index => $genre)
                                    <div id="genre-{{ $index }}"
                                        class=" border-b border-b-gray-300 w-full flex items-center justify-between space-x-2">
                                        <button type="button"
                                            wire:click="setSelectedGenre({{ $genre->id }}, '{{ $genre->name }}')"
                                            class="w-full text-start p-1 hover:bg-gray-200 ease-in duration-150">{{ $genre->name }}</button>
                                        <button type="button"
                                            class="w-fit bg-gray-300 px-1 h-fit hover:bg-rose-400 hover:text-gray-200 ease-in duration-150 text-sm font-medium"
                                            @click="removeGenre({{ $index }})">x</button>
                                    </div>
                                @empty
                                    <div class="text-base font-medium w-full text-center">genre tidak
                                        ada/ditemukan</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Tag --}}
                <div class="space-y-2 pb-2" :class="tag ? 'border-b border-gray-400' : ''">
                    <div :class="!tag ? 'border-b border-b-gray-400' : ''">
                        <button type="button" @click="tag = ! tag"
                            class="flex space-x-4 gray  w-full py-2 cursor-pointer">
                            <div>
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                    class="ease-in duration-200" :class="tag ? 'rotate-180' : ''"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                    </g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M15 11L12.2121 13.7879C12.095 13.905 11.905 13.905 11.7879 13.7879L9 11M7 21H17C19.2091 21 21 19.2091 21 17V7C21 4.79086 19.2091 3 17 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21Z"
                                            stroke="rgb(31, 41, 55)" stroke-width="2" stroke-linecap="round"></path>
                                    </g>
                                </svg>
                            </div>
                            <x-input-label for="tag">Tag</x-input-label>
                        </button>
                        <div class="text-base font-medium text-gray-400 mt-2" x-text="inputTag" x-show="!tag">
                        </div>
                    </div>
                    <div x-show="tag" x-collapse wire:ignore>
                        <input type="text" placeholder="Pisahkan dengan koma dan spasi (foo, bar)"
                            class="border-x-0 border-t-0 w-full placeholder:text-gray-400 border-b-2 border-b-gray-300 focus:ring-0 py-2 px-1 focus:border-t-0"
                            x-model="inputTag" @keyup="setInputTag" x-on:blur="$wire.tag = inputTag">
                        <div class="w-full h-32 overflow-y-auto ">
                            <div x-show="tagSearchResult.length > 0">
                                <template x-for="(tag, index) in tagSearchResult">
                                    <div :id="'tag-' + index"
                                        class=" border-b border-b-gray-300 w-full flex items-center justify-between space-x-2">
                                        <button class="w-full text-start p-1 hover:bg-gray-200 ease-in duration-150"
                                            x-text="tag" @click.prevent="addTag(tag, index)"></button>
                                        <button type="button" @click="removeTag(tag, index)"
                                            class="w-fit bg-gray-300 px-1 h-fit hover:bg-rose-400 hover:text-gray-200 ease-in duration-150 text-sm font-medium">x</button>
                                    </div>
                                </template>
                            </div>
                            <div x-show="tagSearchResult.length == 0">
                                <template x-for="(tag, index) in tagSearchResult">
                                    <div :id="'tag-' + index"
                                        class=" border-b border-b-gray-300 w-full flex items-center justify-between space-x-2">
                                        <button class="w-full text-start p-1 hover:bg-gray-200 ease-in duration-150"
                                            x-text="tag" @click.prevent="addTag(tag, index)"></button>
                                        <button type="button" @click="removeTag(tag, index)"
                                            class="w-fit bg-gray-300 px-1 h-fit hover:bg-rose-400 hover:text-gray-200 ease-in duration-150 text-sm font-medium">x</button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Date picker --}}
                <livewire:admin.series.set-date wire:model="date" />
                {{-- Permalink --}}
                <livewire:admin.series.set-slug wire:model="slug" />
                {{-- Poster --}}
                <div class="space-y-2 pb-2" :class="poster ? 'border-b border-gray-400' : ''">
                    <div :class="!poster ? ' border-b border-b-gray-400' : ''">
                        <button type="button" @click="poster = ! poster"
                            class="flex space-x-4 gray w-full py-2 cursor-pointer">
                            <div>
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                    class="ease-in duration-200" :class="poster ? 'rotate-180' : ''"
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
                                <x-input-label for="poster">Poster</x-input-label>
                                @error('gallery_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                @if ($urlPoster)
                                    <div class="w-full relative">
                                        <img src="{{ asset('storage/' . $urlPoster) }}" alt=""
                                            srcset="" class="w-1/2 h-20 object-contain object-left">
                                        <div wire:click="removePoster"
                                            class="absolute h-5 w-5 rounded-lg flex items-center justify-center -top-3 right-1/2 bg-gray-400 text-white hover:bg-rose-500">
                                            x</div>
                                    </div>
                                @endif
                            </div>
                        </button>
                        <div x-show="poster" x-collapse>
                            <x-primary-button type="button" x-data
                                x-on:click="$dispatch('open-modal', 'add-poster')">{{ $urlPoster ? 'change poster' : 'add poster' }}</x-primary-button>
                        </div>
                    </div>
                </div>
                {{-- status --}}
                <div class="space-y-2 pb-2" :class="status ? 'border-b border-gray-400' : ''">
                    <div :class="!status ? 'border-b border-b-gray-400' : ''">
                        <button type="button" @click="status = ! status"
                            class="flex space-x-4 gray  w-full py-2 cursor-pointer">
                            <div>
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                    class="ease-in duration-200" :class="status ? 'rotate-180' : ''"
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
                            <div class="text-start">
                                <x-input-label for="status">Status</x-input-label>
                                @error('status')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                <input type="text" disabled
                                    class="border-0 focus:border-0 p-0 text-base font-medium text-gray-400 outline-none"
                                    wire:model="status">
                            </div>
                        </button>
                    </div>
                    <div x-show="status" x-collapse class="space-y-2">
                        <div class="flex items-center">
                            <input id="finish" type="radio" value="finish" name="status"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                wire:model="status">
                            <label for="finish"
                                class="ms-2 text-base font-medium text-gray-800  dark:text-gray-300">Finish</label>
                        </div>
                        <div class="flex items-center">
                            <input id="ongoing" type="radio" value="ongoing" name="status"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                wire:model="status">
                            <label for="ongoing"
                                class="ms-2 text-base font-medium text-gray-800  dark:text-gray-300">Ongoing</label>
                        </div>
                        <div class="flex items-center">
                            <input id="pending" type="radio" value="pending" name="status"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                wire:model="status">
                            <label for="pending"
                                class="ms-2 text-base font-medium text-gray-800  dark:text-gray-300">Pending</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <x-modal name="add-poster" :show="$errors->isNotEmpty()">
        <livewire:admin.gallery.create />
    </x-modal>
</div>
