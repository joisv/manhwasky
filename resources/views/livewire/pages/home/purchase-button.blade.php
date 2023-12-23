<div>
    @if (!$series->is_free)
        <x-primary-btn class="border border-gray-400" @click="$dispatch('open-modal', 'purchase-alert')">
            <h3 class="text-base sm:text-xl font-comicRegular">Beli</h3>
            <div class="flex items-center">
                <x-icons.coins default="20px" />
                <p class="text-base sm:text-xl font-comicRegular">{{ number_format($series->price) }}</p>
            </div>
        </x-primary-btn>
    @endif
    <x-modal name="purchase-alert" :show="$errors->isNotEmpty()" maxWidth="sm">
        <div class="bg-white p-2 space-y-2">
            <h1 class="text-xl">Unlock this manga/manhwa 🥳</h1>
            <p class="font-comicRegular">Buka manga atau manhwa ini tanpa ribet, dan kamu bisa nyaman baca tanpa ada
                iklan atau di-redirect ke sana-sini. Semua ini bisa kamu nikmati dengan coins {{ $series->price }}</p>
            <div class="flex items-center w-full space-x-2">
                <x-primary-btn class="border border-gray-400" @click="show = false">
                    Batal
                </x-primary-btn>
                <x-primary-btn class="w-full bg-primary" wire:click="handlePurchase">
                    <p class="text-white">Lanjutkan</p>
                </x-primary-btn>
            </div>
        </div>
    </x-modal>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
