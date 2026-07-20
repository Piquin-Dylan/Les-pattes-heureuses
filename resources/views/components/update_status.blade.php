@props([
    'enum',
    'model',
    'action',
])

<form wire:submit.prevent="{{ $action }}">
    <select wire:model.live="{{ $model }}">
        @foreach($enum::cases() as $status)
            <option value="{{ $status->value }}">
                {{ $status->label() }}
            </option>
        @endforeach
    </select>

    <button type="submit">
        Valider
    </button>
</form>
