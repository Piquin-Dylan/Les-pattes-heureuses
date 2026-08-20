@props([
    'title',
    'description' => null,
])

    <div>
        <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">
            {{ $title }}
        </h2>

        @if($description)
            <p class="mt-2 text-gray-500">
                {{ $description }}
            </p>
        @endif
    </div>

