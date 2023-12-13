<x-home-layout>
        <div
            class="h-[45vh] sm:h-[50vh] md:h-[60vh] lg:h-[80vh] w-full relative overflow-visible bg-[url('https://pbs.twimg.com/media/E-K3UTCVIAkIgvF.png')] bg-cover bg-no-repeat">
            <div class="backdrop-blur-md w-full h-full bg-gray-900 bg-opacity-40 ">
                {{-- slide --}}
                <livewire:pages.home.sliders />
            </div>
        </div>
        <livewire:pages.home.today />
</x-home-layout>
