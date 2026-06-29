@props([
    'label_name',
    'for_label',
    'name',
    'id',
    'options' => [],
])

<div class="mb-4 flex flex-col pt-3">

    <label
        class="pb-2 font-semibold text-[#2F2F2F]"
        for="{{ $for_label }}">
        {{ $label_name }}
    </label>

    <select
        name="{{ $name }}"
        id="{{ $id }}"
        {{ $attributes->merge([
            'class' => '
                w-full
                rounded-2xl
                border
                border-[#E7D7C7]
                bg-white
                px-5
                py-4
                text-[#2F2F2F]
                outline-none
                transition
                duration-200
                focus:border-[#C67C47]
                focus:ring-4
                focus:ring-[#C67C47]/20
            '
        ]) }}>

        <option value="">
            -- Sélectionner --
        </option>

        @foreach($options as $option)

            @if($option instanceof \UnitEnum)

                <option value="{{ $option->value }}">
                    {{ method_exists($option, 'label') ? $option->label() : $option->value }}
                </option>

            @else

                <option value="{{ $option->id }}">
                    {{ $option->name }}
                </option>

            @endif

        @endforeach

    </select>

    @error('form.' . $name)
    <small class="pt-2 text-red-500">
        {{ $message }}
    </small>
    @enderror

</div>
