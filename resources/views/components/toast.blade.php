@props([])

<div
    x-data="{
        show: {{ session()->has('success') ? 'true' : 'false' }},
        message: @js(session('success', '')),
        type: 'success',
        timeout: null,
    }"
    x-init="if (show) { timeout = setTimeout(() => show = false, 4000) }"
    x-on:toast.window="
        message = $event.detail.message;
        type = $event.detail.type ?? 'success';
        show = true;
        clearTimeout(timeout);
        timeout = setTimeout(() => show = false, 4000);
    "
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-y-2 opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="translate-y-2 opacity-0"
    class="fixed top-6 right-6 z-50 w-[calc(100%-3rem)] max-w-sm sm:w-auto"
    style="display: none;"
>
    <div
        :class="type === 'error' ? 'border-red-200' : 'border-green-200'"
        class="flex items-center gap-3 rounded-2xl border bg-white px-5 py-4 shadow-xl"
    >
        <span
            :class="type === 'error' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600'"
            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-lg font-bold"
        >
            <span x-show="type !== 'error'">✓</span>
            <span x-show="type === 'error'" x-cloak>!</span>
        </span>

        <p class="text-sm font-medium text-gray-800" x-text="message"></p>

        <button
            type="button"
            x-on:click="show = false"
            class="ml-auto shrink-0 text-gray-400 transition hover:text-gray-600"
            aria-label="Fermer"
        >
            ✕
        </button>
    </div>
</div>
