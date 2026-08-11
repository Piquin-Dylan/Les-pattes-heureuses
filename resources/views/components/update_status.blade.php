@props([
    'enum',
    'model',
    'action',
])

<form wire:submit.prevent="{{ $action }}" class="flex items-center gap-2">

    <select
        wire:model.live="{{ $model }}"
        class="flex-1 rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm font-medium text-gray-700 outline-none transition focus:border-[#C67C47] focus:ring-4 focus:ring-[#C67C47]/20">

        @foreach($enum::cases() as $status)
            <option value="{{ $status->value }}">
                {{ $status->label() }}
            </option>
        @endforeach

    </select>

    <button
        type="submit"
        class="shrink-0 cursor-pointer rounded-xl bg-[#C67C47] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b56f3c] active:scale-95">

        Valider

    </button>

</form>
