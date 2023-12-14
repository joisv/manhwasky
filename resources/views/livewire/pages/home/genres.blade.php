<div class="min-h-screen" x-data="{
    showGenre: false,
}">
    {{-- mobile: ambil 6/7 data index ke 0-2 show 3-6 hidden --}}
    <div class="h-full w-full items-center justify-between flex border-gray-300 "
        :class="showGenre ? 'border-t' : 'border-y'">
        <div class="grid grid-cols-5 lg:grid-cols-8 xl:grid-cols-10 items-center justify-between w-full py-2 ">
            @foreach ($staticGenre as $index => $genre)
                @if ($index >= 5)
                {{-- mobile --}}
                    <div class="hidden xl:flex items-center justify-center w-full h-full py-2">
                        <p class="font-comicRegular text-base sm:text-xl">{{ $genre->name }}</p>
                    </div>
                @else
                    <div class="flex items-center justify-center w-full h-full py-2">
                        <p class="sm:text-xl font-comicRegular text-base">{{ $genre->name }}</p>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="flex items-center justify-center h-full border-l border-gray-300 w-fit sm:px-3">
            <button type="button" @click="showGenre = ! showGenre" class="sm:text-xl font-comicRegular text-sm">
                <x-icons.arrow default="20px" rotate="rotate(90), rotate(180)"
                    color="rgb(209 213 219 / var(--tw-border-opacity))" />
            </button>
        </div>
    </div>
    <div class="space-y-2 w-[96.9%] " x-cloak x-show="showGenre" x-collapse>
        <div class="grid  grid-cols-5 lg:grid-cols-8 xl:grid-cols-10">
            @foreach ($allGenre as $index => $genre)
                <div class="flex items-center justify-center w-full h-full py-3 border border-gray-300">
                    <p class="sm:text-lg font-comicRegular text-base">{{ $genre->name }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
