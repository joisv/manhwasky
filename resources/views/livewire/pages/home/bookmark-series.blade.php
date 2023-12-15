<div>
    <button type="button"  class="flex flex-col justify-center items-center bg-gra" wire:click="bookmarkSeries">
        <div wire:loading.remove wire:target="bookmarkSeries">
            <x-icons.bookmark default="35px" color="{{ $hasSeries ? 'rgb(17 24 39)' : 'rgb(156, 163, 175)' }}" />
        </div>
        <span wire:loading wire:target="bookmarkSeries" class="text-xs text-gray-400">loading</span>
        <p class="{{ $hasSeries ? 'text-gray-900' : 'text-gray-400' }} text-sm">Bookmark</p>
    </button>
</div>
