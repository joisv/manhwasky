<button {{ $attributes->merge(['class' => 'hover:start-read ease-in duration-100 hover:-translate-y-[2px] rounden-sm px-5 py-2 flex items-center space-x-1']) }}>
    {{ $slot }}
</button>