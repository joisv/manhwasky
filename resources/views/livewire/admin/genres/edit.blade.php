<div class="p-3 space-y-3" @re-render.window="show = false">
    <header class="flex justify-between items-center">
        <h1 class="text-lg font-semibold">Edit Genre</h1>
    </header>
    <form wire:submit="save">
        <input type="text" class="border-x-0 border-t-0 w-full placeholder:text-gray-400 border-b-2 border-b-gray-300 focus:ring-0 py-2 px-1 focus:border-t-0" wire:model="name">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror
        <x-primary-button type="submit" class="mt-3 disabled:bg-gray-700" wire:loading.attr="disabled">Save</x-primary-button>
    </form>
</div>
