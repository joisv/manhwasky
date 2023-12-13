<x-home-layout>
    <div class="min-h-screen max-w-5xl mx-auto space-y-4">
        <div class="sm:grid grid-cols-4 items-center">
            <div class="w-full bg-red-400 h-72 col-span-2"></div>
            <div class="flex justify-between w-full col-span-2  p-2 font-comicBold h-fit">
                <div class="w-full">
                    <div class="flex items-center space-x-1 ">
                        <div class="text-sm px-1 text-white bg-primary">status</div>
                        <div class="text-sm px-1 border border-primary">category</div>
                    </div>
                    <div class="flex w-full justify-between items-start">
                        <div>
                            <h1 class="text-3xl ">Boarding Diary</h1>
                            <p class="text-base text-gray-400">Original title</p>
                        </div>
                        <div>
                            <div class="flex flex-col justify-center items-center">
                                <button type="button">
                                    <x-icons.bookmark default="35px" />
                                </button>
                                <p class="text-gray-300 text-sm">Bookmark</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 space-y-2">
                        <div class="flex space-x-1">
                            <h3 class="sm:text-xl text-lg text-gray-600">Genre:</h3>
                            <div class="flex flex-wrap gap-1 w-full">
                                <div
                                    class="px-2 py-1 h-fit sm:text-base text-sm text-gray-500 font-comicRegular bg-gray-200 flex items-center justify-center rounded-sm">
                                    #genre
                                </div>
                            </div>
                        </div>
                        <div class="flex space-x-1">
                            <h3 class="sm:text-xl text-lg text-gray-600">Tags:</h3>
                            <div class="flex flex-wrap gap-1 w-full">
                                <div
                                    class="px-2 py-1 h-fit sm:text-base text-sm text-gray-500 font-comicRegular bg-gray-200 flex items-center justify-center rounded-sm">
                                    #tag
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <button type="button" class="rounden-sm px-5 py-1 bg-primary flex items-center space-x-1">
                            <h3 class="text-white text-xl font-comicRegular">Mulai membaca</h3>
                            <x-icons.book default="20px" />
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <div class="flex flex-col-reverse sm:grid grid-cols-3 gap-3">
            <div class="space-y-3 w-full border border-gray-300 p-3 rounded-sm h-fit">
                <div>
                    <header class="text-xl text-gray-600 font-comicBold">Newsfeed</header>
                    <div class="h-16 w-full bg-rose-500"></div>
                </div>
                <div class="space-y-1">
                    <header class="text-xl text-gray-600 font-comicBold">Trending</header>
                    <div class="flex items-center space-x-3">
                        <div class="h-20 w-20 bg-violet-500">
                        </div>
                        <div>
                            <h3 class="font-comicBold text-lg">My Aunt</h3>
                            <p class="text-sm">Dec 2 2023</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full border-t-2 border-gray-300 rota pt-2 col-span-2 max-h-screen overflow-y-auto p-3">
                <div class="flex relative w-full justify-end">
                    <button class="block">
                        <div class="absolute right-3">
                            <x-icons.arrow rotate="rotate(90)" color="rgb(209 213 219)" default="30px" />
                        </div>
                        <div class="absolute right-0">
                            <x-icons.arrow rotate="rotate(90), rotate(180)" default="30px" />
                        </div>
                    </button>
                </div>
                <div class="space-y-2 mt-9">
                    <div class="flex space-x-3 items-center">
                        <div class="w-36 sm:h-40 h-36 bg-cyan-500"></div>
                        <div class="sm:flex justify-between w-full items-center">
                            <div>
                                <h1 class="sm:text-2xl text-xl font-comicBold">Episode 1</h1>
                                <p class="sm:text-lg">I need more power</p>
                                <p class="text-sm">Dec 02 2023</p>
                            </div>
                            <div class="py-1 px-4 border-2 border-gray-300 text-primary rounded-sm text-xm w-fit mt-2 sm:mt-0">Free</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>
