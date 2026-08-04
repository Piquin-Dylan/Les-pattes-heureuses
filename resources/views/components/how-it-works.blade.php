@props([])

@php
    $steps = [
        ['title' => 'Parcourez nos animaux', 'description' => "Explorez les fiches de nos pensionnaires et trouvez celui qui vous correspond."],
        ['title' => 'Faites une demande', 'description' => "Remplissez un formulaire d'adoption, notre équipe l'étudie rapidement."],
        ['title' => 'Rencontrez votre compagnon', 'description' => "Venez faire connaissance et accueillez-le dans son nouveau foyer."],
    ];
@endphp

<section class="bg-[#FBF4EC] px-8 py-20">
    <div class="mx-auto max-w-7xl">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold text-gray-900">Comment adopter ?</h2>
            <p class="mt-2 text-gray-500">Trois étapes simples pour offrir un foyer à un animal.</p>
        </div>

        <div class="relative mt-14 grid gap-10 sm:grid-cols-3">
            <div class="absolute left-0 right-0 top-6 hidden h-0.5 bg-[#C67C47]/20 sm:block"></div>

            @foreach($steps as $index => $step)
                <div class="relative text-center">
                    <div class="relative z-10 mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#C67C47] font-bold text-white shadow-md">
                        {{ $index + 1 }}
                    </div>
                    <h3 class="mt-5 text-lg font-bold text-gray-900">{{ $step['title'] }}</h3>
                    <p class="mt-2 text-sm text-gray-500">{{ $step['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
