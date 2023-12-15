<x-home-layout>
    <div
        class="h-[40vh] sm:h-[50vh] md:h-[60vh] lg:h-[80vh] w-full relative overflow-visible bg-[url('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEi5zCJnNbqIdRNSkPGqYi7GPdysgDY-v7SAy3paTIsjygpRwIQ7UCAyCd3UKxT04h4z31SfiXTOq244niVcltNcR3Mxle89ild1xfJ_LFzfWq36YtWYmPA0jV83I31iaDR-sEsYe1nKucV38ucT9bGXQd9nEfJjGdALmhEf4SvykBx1G_3Xmn2Z2lZv/w600-h337-p-k-no-nu/%ED%83%91%ED%88%B0_%EC%9B%B9%ED%88%B0_%ED%95%98%EC%88%99%EC%9D%BC%EA%B8%B0.png')] bg-cover bg-no-repeat">
        <div class="backdrop-blur-md w-full h-full bg-gray-900 bg-opacity-40 ">
            {{-- slide --}}
            <livewire:pages.home.sliders />
        </div>
    </div>
    <div class="w-full min-h-screen space-y-20 sm:space-y-10">
        <livewire:pages.home.today />
        <livewire:pages.home.new-release />
    </div>
</x-home-layout>
