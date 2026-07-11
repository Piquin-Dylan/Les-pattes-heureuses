@props([
    'animal',
])

<div
    x-data="{ open: false }"
    class="inline-block">

    <button
        @click="open = true"
        type="button"
        class="rounded-xl border border-[#C67C47] px-5 py-3 font-semibold text-[#C67C47] transition hover:bg-[#C67C47] hover:text-white cursor-pointer">
        Partager

    </button>

    <div
        x-show="open"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

        <div
            @click.outside="open = false"
            class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl">

            <h2 class="text-xl font-bold text-gray-900">
                Partager {{ $animal->name }}
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                Copiez le lien ci-dessous pour le partager par e-mail, SMS ou messagerie.
            </p>

            <input
                id="share-url"
                readonly
                value="{{ route('animals.show', $animal->slug) }}"
                class="mt-5 w-full rounded-xl border border-gray-300 px-4 py-3">

            <div class="mt-6 flex justify-end gap-3">

                <button
                    @click="navigator.clipboard.writeText(document.getElementById('share-url').value); alert('Lien copié !')"
                    class="rounded-xl bg-[#C67C47] px-5 py-3 font-semibold text-white transition hover:bg-[#b56f3c] cursor-pointer">
                    Copier le lien
                </button>
                <button
                    @click="open = false"
                    class="rounded-xl border border-gray-300 px-5 py-3 font-semibold cursor-pointer">
                    Fermer
                </button>

            </div>

        </div>

    </div>

</div>
