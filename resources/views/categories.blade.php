<x-home-layout>
    <x-slot name="seo">
        {!! seo($seo) !!}
    </x-slot>
    <livewire:pages.home.categories :categories="$allcategories" :category="$categoryname" />
</x-home-layout>