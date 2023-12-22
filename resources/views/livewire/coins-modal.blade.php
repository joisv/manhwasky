<div class="bg-white p-2 rounded-sm flex flex-col justify-center items-center space-y-3" @close-modal.window="show = false">
    <div class="w-full text-start">
        <h1 class="text-lg font-comicBold">Dapatkan coins dengan click tombol dibawah</h1>
        <p class="font-comicRegular text-base">Fitur ini ada untuk memaksimalkan pengalaman user dalam menggunakan aplikasi / web, user dapat
            membaca comic tanpa terganggu dengan iklan, coin yang didapat bisa digunakan untuk mengakses manga /
            manhwa yang </p>
    </div>
    <button wire:click="getCoins" wire:loading.attr="disabled" type="button" class="disabled:opacity-50 p-2 bg-primary rounded-sm text-lg w-full text-white">get coins</button>
</div>