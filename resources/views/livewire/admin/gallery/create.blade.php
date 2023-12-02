<div class="p-4 max-h-[93vh]" x-data="{
    activeTabPoster: $persist('uploadLocal'),
    removeSelectBorder: null,
    selectedId: null,
    urlPoster: '',

    init() {
        this.removeSelectBorder = document.getElementsByClassName('imgPoster')
        this.resetSelectedImgBorder()
    },

    selectPoster(id, url, i) {
        this.resetSelectedImgBorder()
        const imgSelect = document.getElementById('gallery-' + i);
        imgSelect.classList.remove('hover:ring-2', 'hover:ring-blue-500')
        imgSelect.classList.add('ring-4', 'ring-blue-500')
        this.selectedId = id
        this.urlPoster = url
    },
    handleSelectedPoster() {
        if (this.selectedId && this.urlPoster) {
            $dispatch('select-poster', { id: this.selectedId, url: this.urlPoster })
            show = !show
            poster = false
        } else {
            $dispatch('alert-me', { status: 'error', message: 'pilih gambar dulu' });
        }
    },
    deletePoster(){
        if(this.selectedId){
            $dispatch('delete-poster', { id: this.selectedId })
        } else {
            $dispatch('alert-me', { status: 'error', message: 'pilih gambar untuk dihapus' });
        }
    },
    resetSelectedImgBorder() {
        this.selectedId = '';
        this.urlPoster = '';
        for (let i = 0; i < this.removeSelectBorder.length; i++) {
            this.removeSelectBorder[i].classList.remove('ring-4', 'ring-blue-500')
        }
    },
}" @re-render.window="() => {
    activeTabPoster = 'gallery';
    $wire.getGalleries();
}">
    <header class="flex justify-between items-center">
        <h1 class="text-lg font-semibold">Menambahkan gambar</h1>
        <div class="flex mt-2 space-x-2" x-show="activeTabPoster === 'gallery'">
            <x-primary-button 
            @click="handleSelectedPoster">pilih</x-primary-button>
            <x-danger-button @click="deletePoster">delete</x-danger-button>
        </div>
    </header>
    <div class="flex space-x-3 mt-3">
        <button @click="activeTabPoster = 'gallery'" class="p-1 text-base font-medium outline-none"
            :class="{ 'border-b border-b-blue-600': activeTabPoster === 'gallery' }">Gallery</button>
        <button @click="activeTabPoster = 'uploadLocal'" class="p-1 text-base font-medium outline-none"
            :class="{ 'border-b border-b-blue-600': activeTabPoster === 'uploadLocal' }">Upload local</button>
    </div>
    <div class="w-full mt-4 overflow-y-auto max-h-[70vh]">
        <div x-cloak x-show="activeTabPoster === 'gallery'">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 p-2"
                @click.outside="resetSelectedImgBorder">
                @forelse ($galleries as $index => $gallery)
                    <img id="gallery-{{ $index }}"
                        @click="selectPoster({{ $gallery->id }}, '{{ $gallery->image }}', {{ $index }})"
                        src="{{ asset('storage/'.$gallery->image) }}" alt="" srcset=""
                        class="imgPoster w-full object-contain object-left hover:ring-2 hover:ring-blue-500 ease-in duration-100 cursor-pointer">
                @empty
                @endforelse
            </div>
        </div>
        <div x-cloak x-show="activeTabPoster === 'uploadLocal'">
            <form wire:submit="saveImage">
                @if ($images)
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach ($images as $image)
                            <img src="{{ $image->temporaryUrl() }}" alt="" srcset=""
                                class="object-cover object-center">
                        @endforeach
                    </div>
                @endif
            <div class="flex items-center justify-center w-full">
                @empty($images)
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                    to
                                    upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                800x400px)
                            </p>
                        </div>
                    </label>
                @endempty
                <input id="dropzone-file" type="file" class="hidden" multiple wire:model="images" />
            </div>
            <div class="flex items-center space-x-2 py-4">
                <x-primary-button type="submit" class="mt-2 absolute bottom-2 disabled:bg-gray-600" wire:loading.attr="disabled">upload</x-primary-button>
                @error('images')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </form>
    </div>
</div>
<div class="w-full h-64 justify-center items-center absolute top-1/3 " wire:loading.flex>
    <svg width="64px" height="64px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none"
        class="animate-spin">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
            <g fill="#f43f5e" fill-rule="evenodd" clip-rule="evenodd">
                <path d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8z" opacity=".2">
                </path>
                <path
                    d="M7.25.75A.75.75 0 018 0a8 8 0 018 8 .75.75 0 01-1.5 0A6.5 6.5 0 008 1.5a.75.75 0 01-.75-.75z">
                </path>
            </g>
        </g>
    </svg>
    <span class="sr-only">Loading...</span>
</div>
</div>
