<x-home-layout>
    <x-slot name="seo">
        {!! seo($series ?? null) !!}
    </x-slot>
    <livewire:pages.home.content :series="$series"/>
</x-home-layout>
