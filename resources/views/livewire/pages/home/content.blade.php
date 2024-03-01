<div class="min-h-screen max-w-5xl mx-auto space-y-4">
    <div class="sm:grid grid-cols-4 items-center xl:p-0">
        <div class="w-full h-72 col-span-2 overflow-hidden">
            <img src="{{ asset('storage/' . $series->gallery->image) }}" alt=""
                class="object-cover w-full h-full object-top">
        </div>
        <div class="flex justify-between w-full col-span-2 p-2 font-comicBold h-fit">
            <div class="w-full">
                <div class="flex items-center space-x-1 ">
                    <div class="text-sm px-1 text-white bg-primary">{{ $series->status }}</div>
                    <a href="{{ route('home.categories', ['cat' => $series->category->name]) }}"
                        class="text-sm px-1 border border-primary" wire:navigate>{{ $series->category->name }}</a>
                </div>
                <div class="flex w-full justify-between items-start">
                    <div>
                        <h1 class="text-3xl ">{{ $series->title }}</h1>
                        <p class="text-base text-gray-400">{{ $series->original_title }}</p>
                    </div>
                    <livewire:pages.home.bookmark-series :series="$series" />
                </div>
                <div class="mt-5 space-y-2">
                    <div class="flex space-x-1">
                        <h3 class="sm:text-xl text-lg text-gray-600">Genre:</h3>
                        <div class="flex flex-wrap gap-1 w-full">
                            @foreach ($series->genres as $genre)
                                <a href="{{ route('home.genres', ['g' => $genre->name]) }}"
                                    class="px-2 py-1 h-fit sm:text-base text-sm text-gray-500 font-comicRegular bg-gray-200 flex items-center justify-center rounded-sm"
                                    wire:navigate>
                                    #{{ $genre->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex space-x-1">
                        <h3 class="sm:text-xl text-lg text-gray-600">Tags:</h3>
                        <div class="flex flex-wrap gap-1 w-full">
                            @empty(!$series->tag)
                                @foreach (explode(',', trim($series->tag, ', ')) as $tag)
                                    <div
                                        class="px-2 py-1 h-fit sm:text-base text-sm text-gray-500 font-comicRegular bg-gray-200 flex items-center justify-center rounded-sm">
                                        #{{ $tag }}
                                    </div>
                                @endforeach
                            @endempty
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex items-center space-x-3">
                    @empty(!$series->chapters()->first())
                        <x-primary-btn type="button" class="bg-primary" wire:click="startRead">
                            <h3 class="text-white xl:text-xl text-lg font-comicRegular">Mulai membaca</h3>
                            <x-icons.book default="20px" />
                        </x-primary-btn>
                        <livewire:pages.home.purchase-button :$series :$hasSeries :$user />
                    @endempty
                </div>
            </div>

        </div>
    </div>
    <div class="flex flex-col-reverse sm:grid sm:grid-cols-3 sm:gap-2 min-h-[50vh]" x-data="{
        activeTab: 'preview'
    }">
        <livewire:pages.home.trending />
        <div class="w-full border-t-2 border-gray-200 rota pt-2 col-span-2 p-3">
            <div class="grid grid-cols-3 gap-2">
                <div>
                    <button :class="{ 'border-b-2 border-b-gray-400': activeTab === 'preview' }"
                        @click.prevent="activeTab = 'preview'"
                        class="text-base sm:text-xl font-comicBold text-gray-600 w-full p-2">preview</button>
                </div>
                <div>
                    <button :class="{ 'border-b-2 border-b-gray-400': activeTab === 'chapters' }"
                        @click.prevent="() => {
                    $wire.getChapters();
                    activeTab = 'chapters'    
                    }"
                        class="text-base sm:text-xl font-comicBold text-gray-600 w-full p-2">chapters</button>
                </div>
                <div>
                    <button :class="{ 'border-b-2 border-b-gray-400': activeTab === 'recommend' }"
                        @click.prevent="() => {
                            $dispatch('get-recommend')
                    activeTab = 'recommend'    
                    }" class="text-base sm:text-xl font-comicBold text-gray-600 w-full p-2">recommend</button>
                </div>
            </div>
            <div :class="{ 'max-h-screen': activeTab != 'preview' }" class="overflow-y-auto">
                <div x-cloak x-show="activeTab === 'preview'">
                    <livewire:pages.home.preview :$series />
                </div>
                <div x-cloak x-show="activeTab === 'chapters'">
                    {{-- sort --}}
                    <div class="flex relative w-full justify-end">
                        <button class="block" wire:click="setDirection">
                            <div class="absolute right-3">
                                <x-icons.arrow rotate="rotate(90)"
                                    color="{{ !$direction ? 'rgb(209 213 219)' : '#000000' }}" default="30px" />
                            </div>
                            <div class="absolute right-0">
                                <x-icons.arrow rotate="rotate(90), rotate(180)" default="30px"
                                    color="{{ $direction ? 'rgb(209 213 219)' : '#000000' }}" />
                            </div>
                        </button>
                    </div>
                    {{-- chapters --}}
                    <div class="space-y-2 mt-9">
                        @empty(!$chapters)
                            @forelse ($chapters as $chapter)
                                <div class="flex space-x-3 items-center">
                                    <div class="w-36 sm:h-40 h-36 relative overflow-hidden">
                                        <img src="{{ $chapter->thumbnail ? asset('storage/' . $chapter->thumbnail) : 'https://placehold.co/144x160?text=Thumb+not+found' }}"
                                            alt="" class="w-full h-full object-cover">
                                    </div>
                                    <div wire:click="chapterRead({{ $chapter->is_free }}, '{{ $chapter->slug }}')"
                                        class="sm:flex justify-between w-full items-center cursor-pointer">
                                        <div>
                                            <h1 class="sm:text-2xl text-xl font-comicBold">{{ $chapter->title }}</h1>
                                            <p class="text-sm">
                                                {{ Carbon\Carbon::createFromFormat('Y-m-d', $chapter->created)->format('F j, Y') }}
                                            </p>
                                        </div>
                                        @if ($chapter->series->is_free || $chapter->is_free)
                                            <div
                                                class="py-1 px-4 border-2 border-gray-300 bg-gra text-primary rounded-sm text-xm w-fit mt-2 sm:mt-0">
                                                Free</div>
                                        @elseif($hasSeries)
                                            <div
                                                class="py-1 px-4 border-2 border-gray-300 bg-gra text-primary rounded-sm text-xm w-fit mt-2 sm:mt-0">
                                                Unlocked</div>
                                        @else
                                            <x-icons.padlock default="25px" color="rgb(107, 114, 128)" />
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="flex justify-center items-center min-h-[45vh] h-full text-lg sm:text-xl text-gray-400 font-comicBold">
                                    tidak ada chapter</div>
                            @endforelse
                        @endempty
                        <div class=" min-h-[45vh] justify-center items-center" wire:loading.flex wire:target="getChapters">
                            <p class="text-3xl text-gray-400 animate-pulse font-comicBold">loading...</p>
                        </div>
                    </div>
                </div>
                <div x-cloak x-show="activeTab === 'recommend'">
                    <livewire:pages.home.recommend :$series />
                </div>
            </div>
        </div>
    </div>
    <x-modal name="coins-required" :show="$errors->isNotEmpty()" maxWidth="sm">
        <div class="bg-white p-2 space-y-2">
            <h1 class="text-xl font-comicBold">Dapatkan coin untuk baca manhwa/manga ini 🥳</h1>
            <p class="font-comicRegular">Buka manga atau manhwa ini tanpa ribet, dan kamu bisa nyaman baca tanpa ada
                iklan atau di-redirect ke sana-sini. Semua ini bisa kamu nikmati dengan coins</p>
            <div class="flex items-center w-full space-x-2">
                <x-primary-btn class="border border-gray-400" @click="show = false">
                    Batal
                </x-primary-btn>
                <x-primary-btn class="w-full bg-primary"
                    @click="() => {
                    $dispatch('coins');
                    show = false;    
                }">
                    <p class="text-white">Lanjutkan</p>
                </x-primary-btn>
            </div>
        </div>
    </x-modal>
</div>
