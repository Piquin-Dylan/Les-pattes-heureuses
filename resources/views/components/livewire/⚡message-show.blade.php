<?php

use Livewire\Component;

new class extends Component {

    public \App\Models\Message $message;

};
?>
<div class="mx-auto max-w-5xl space-y-6">

    <a
        href="{{ route('message') }}"
        class="inline-flex items-center gap-2 text-sm font-medium text-[#C67C47] hover:underline">

        ← Retour aux messages

    </a>

    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-200 p-6">

            <h1 class="text-2xl font-bold text-gray-900">
                {{ $message->object }}
            </h1>

            <div class="mt-6 grid gap-6 sm:grid-cols-3">

                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">
                        Expéditeur
                    </p>

                    <p class="mt-1 font-medium text-gray-900">
                        {{ $message->firstName }} {{ $message->lastName }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">
                        Adresse e-mail
                    </p>

                    <a
                        href="mailto:{{ $message->email }}"
                        class="mt-1 block font-medium text-[#C67C47] hover:underline">

                        {{ $message->email }}

                    </a>
                </div>

                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">
                        Date
                    </p>

                       <p class="mt-1 font-medium text-gray-900">
                           {{ $message->created_at->format('d/m/Y à H:i') }}
                       </p>
                </div>

            </div>

        </div>

        <div class="space-y-3 p-6">

            <h2 class="text-lg font-semibold text-gray-900">
                Message
            </h2>

            <div class="rounded-2xl bg-gray-50 p-5 leading-7 whitespace-pre-line text-gray-700">

                {{ $message->message }}

            </div>

        </div>

    </div>

    <div class="flex justify-end">

        <a
            href="mailto:{{ $message->email }}?subject={{ urlencode($message->object) }}&body={{ urlencode('Bonjour ' . $message->firstName . ',' . "\n\n") }}"
            class="rounded-2xl bg-[#C67C47] px-6 py-3 font-semibold text-white transition hover:bg-[#B56F3C]">

            Répondre au message

        </a>

    </div>

</div>
