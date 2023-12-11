<div class="p-3 space-y-3" @re-render.window="show = false">
    <header class="flex justify-between items-center">
        <h1 class="text-lg font-semibold">Menambahkan Genre</h1>
    </header>
    <form wire:submit="save">
        <div class="space-y-3">
            <div>
                <input type="text"
                    class="border-x-0 border-t-0 w-full placeholder:text-gray-400 border-b-2 border-b-gray-300 focus:ring-0 py-2 px-1 focus:border-t-0"
                    wire:model="name">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <x-input-label for="colorPicker" :value="__('Primary color')" />
                <div class="flex items-center">
                    <div class="flex items-center p-1 w-12 rounded-l-sm" style="background-color: {{ $primary_color }}">
                        <input type="color" id="colorPicker" wire:model.live="primary_color" class="opacity-0">
                    </div>
                    <input type="text" wire:model.live="primary_color"
                        class="py-[4.5px] w-fit focus:border-blue-500 border rounded-r-sm border-gray-300">
                </div>
            </div>
        </div>
        <x-primary-button type="submit" class="mt-3 disabled:bg-gray-600" wire:loading.attr="disabled">
            <div class="flex items-center space-x-1 w-full">
                <x-icons.loading wire:loading />
                <h2>
                    Save
                </h2>
            </div>
        </x-primary-button>
    </form>
</div>
