<x-home-layout>
   <x-slot name="seo">
      {!! seo($chapter) !!}
  </x-slot>
   <livewire:pages.home.chapter :chapter="$chapter" :series="$series"/>
</x-home-layout>
