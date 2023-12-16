<div class="min-h-screen max-w-5xl mx-auto space-y-4" wire:init="getChapters">
    <div class="sm:grid grid-cols-4 items-center">
        <div class="w-full h-72 col-span-2 overflow-hidden">
            <img src="{{ asset('storage/' . $series->gallery->image) }}" alt=""
                class="object-cover w-full h-full object-top">
        </div>
        <div class="flex justify-between w-full col-span-2  p-2 font-comicBold h-fit">
            <div class="w-full">
                <div class="flex items-center space-x-1 ">
                    <div class="text-sm px-1 text-white bg-primary">{{ $series->status }}</div>
                    <div class="text-sm px-1 border border-primary">{{ $series->category->name }}</div>
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
                                <div
                                    class="px-2 py-1 h-fit sm:text-base text-sm text-gray-500 font-comicRegular bg-gray-200 flex items-center justify-center rounded-sm">
                                    #{{ $genre->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex space-x-1">
                        <h3 class="sm:text-xl text-lg text-gray-600">Tags:</h3>
                        <div class="flex flex-wrap gap-1 w-full">
                            @foreach (explode(',', trim($series->tag, ', ')) as $tag)
                                <div
                                    class="px-2 py-1 h-fit sm:text-base text-sm text-gray-500 font-comicRegular bg-gray-200 flex items-center justify-center rounded-sm">
                                    #{{ $tag }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="{{ route('chapter', [$series->title, $series->chapters()->first()->slug]) }}"
                        wire:navigate>
                        <button type="button" class="rounden-sm px-5 py-1 bg-primary flex items-center space-x-1">
                            <h3 class="text-white text-xl font-comicRegular">Mulai membaca</h3>
                            <x-icons.book default="20px" />
                        </button>
                    </a>
                </div>
            </div>

        </div>
    </div>
    <div class="flex flex-col-reverse sm:grid grid-cols-3 gap-3 min-h-[50vh]">
        <div class="space-y-3 w-full border border-gray-300 p-3 rounded-sm min-h-full">
            <div>
                <header class="text-xl text-gray-600 font-comicBold">Newsfeed</header>
                <div class="h-16 w-full bg-rose-500"></div>
            </div>
            <div class="space-y-1">
                <header class="text-xl text-gray-600 font-comicBold">Trending</header>
                <div class="flex items-center space-x-3">
                    <div class="h-20 w-20 bg-violet-500">
                    </div>
                    <div>
                        <h3 class="font-comicBold text-lg">My Aunt</h3>
                        <p class="text-sm">Dec 2 2023</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full border-t-2 border-gray-300 rota pt-2 col-span-2 max-h-screen overflow-y-auto p-3">
            <div class="flex relative w-full justify-end">
                <button class="block" wire:click="setDirection">
                    <div class="absolute right-3">
                        <x-icons.arrow rotate="rotate(90)" color="{{ !$direction ? 'rgb(209 213 219)' : '#000000' }}"
                            default="30px" />
                    </div>
                    <div class="absolute right-0">
                        <x-icons.arrow rotate="rotate(90), rotate(180)" default="30px"
                            color="{{ $direction ? 'rgb(209 213 219)' : '#000000' }}" />
                    </div>
                </button>
            </div>
            <div class="space-y-2 mt-9">
                @empty(!$chapters)
                    @forelse ($chapters as $chapter)
                        <div class="flex space-x-3 items-center">
                            <div class="w-36 sm:h-40 h-36 relative overflow-hidden">
                                <img src="{{ $chapter->thumbnail ? asset('storage/'.$chapter->thumbnail) : 'https://placehold.co/144x160?text=Thumb+not+found' }}" alt=""
                                    class="w-full h-full object-cover" wire:loading.remove>
                            </div>
                            <a href="{{ route('chapter', [$chapter->series->title, $chapter->slug]) }}"
                                class="sm:flex justify-between w-full items-center" wire:navigate>
                                <div>
                                    <h1 class="sm:text-2xl text-xl font-comicBold">{{ $chapter->title }}</h1>
                                    <p class="text-sm">
                                        {{ Carbon\Carbon::createFromFormat('Y-m-d', $chapter->created)->format('F j, Y') }}
                                    </p>
                                </div>
                                <div
                                    class="py-1 px-4 border-2 border-gray-300 text-primary rounded-sm text-xm w-fit mt-2 sm:mt-0">
                                    Free</div>
                            </a>
                        </div>
                    @empty
                        <span>tidak ada chapter</span>
                    @endforelse
                @endempty
                <div class="col-span-3 md:col-span-4 min-h-[45vh] justify-center items-center" wire:loading.flex
                    wire:target="getChapters">
                    <p class="text-3xl text-gray-400 animate-pulse font-comicBold">loading...</p>
                </div>
            </div>
        </div>
    </div>
</div>
