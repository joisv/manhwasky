<div class="mt-2 space-y-2" x-data="{
    expanded: false
}">
    <p  class="text-start p-1 bg-gray-200 rounded-md font-comicRegular cursor-pointer" x-collapse.min.55px x-show="expanded"  @click="expanded = ! expanded">{{ $series->overview }}</p>
    <div class="max-w-3xl mx-auto flex justify-center">
        @if (!empty($preview))
            @foreach ($preview->contents as $content)
                <div>
                    <img src="{{ $content->url }}" class="object-fill" alt="">
                </div>
            @endforeach
        @else
            <div
                class="flex justify-center items-center min-h-[45vh] h-full text-lg sm:text-xl text-gray-400 font-comicBold">
                tidak ada preview</div>
        @endif
    </div>
</div>
