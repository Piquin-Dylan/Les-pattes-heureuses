@props([
    "label_name",
    "type",
    "placeholder" => '',
    "for_label",
    "name",
    "id",
])

<div
    class="mb-4 flex flex-col pt-3 justify-center sm:flex-1"
    x-data="{ showPassword: false }">

    <label
        class="pb-2  text-[20px] text-black"
        for="{{ $for_label }}">
        {{ $label_name }}
    </label>
    <div class="relative">
        <input
            type="{{ $type }}"
            placeholder="{{ $placeholder }}"
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
                text-[15px]
                text-[#2F2F2F]
                placeholder:text-gray-400
                outline-none
                transition-all
                duration-200
                focus:border-[#C67C47]
                focus:ring-4
                focus:ring-[#C67C47]/20
                '
            ]) }}>
    </div>

    @error('form.' . $name)
    <small class="text-red-500 pt-2">
        {{ $message }}
    </small>
    @enderror

</div>
