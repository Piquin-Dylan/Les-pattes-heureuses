<div class="space-y-4">

    <article
        wire:key="message-{{ $message->id }}"
        class="rounded-3xl border border-gray-200 bg-white p-5 shadow-sm transition hover:border-[#C67C47]/40 hover:shadow-md sm:p-6">

        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div class="min-w-0 flex-1">

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#C67C47]/10 text-sm font-bold text-[#C67C47]">
                        {{ strtoupper(substr($message->firstName, 0, 1)) }}
                        {{ strtoupper(substr($message->lastName, 0, 1)) }}
                    </div>

                    <div class="min-w-0 flex-1">

                        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:gap-3">

                            <h2 class="truncate text-base font-semibold text-gray-800">
                                {{ $message->firstName }}
                                {{ $message->lastName }}
                            </h2>

                            <span
                                class="w-fit rounded-full bg-[#C67C47]/10 px-3 py-1 text-[0.65rem] font-semibold text-[#C67C47]">
                                                Nouveau message
                                            </span>

                        </div>

                        <p class="mt-1 truncate text-sm text-gray-500">
                            {{ $message->email }}
                        </p>

                    </div>

                </div>

                <div class="mt-5">

                    <p class="text-sm font-semibold text-gray-800">
                        {{ $message->object }}
                    </p>

                    <p class="mt-2 line-clamp-2 text-sm leading-6 text-gray-500">
                        {{ $message->message }}
                    </p>

                </div>

            </div>

            <div
                class="flex shrink-0 flex-col gap-4 border-t border-gray-100 pt-4 lg:min-w-52 lg:border-l lg:border-t-0 lg:pl-6 lg:pt-0">

                <div>
                                    <span class="block text-xs text-gray-400">
                                        Téléphone
                                    </span>

                    <p class="mt-1 text-sm font-medium text-gray-700">
                        {{ $message->phone }}
                    </p>
                </div>

                <div>
                                    <span class="block text-xs text-gray-400">
                                        Reçu le
                                    </span>

                    <p class="mt-1 text-sm font-medium text-gray-700">
                        {{ $message->created_at->format('d/m/Y à H:i') }}
                    </p>
                </div>

                <a
                    href="#"
                    class="inline-flex w-full items-center justify-center rounded-2xl bg-[#C67C47] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#b56f3c] active:scale-95">
                    Voir le message
                </a>

            </div>

        </div>

    </article>
</div>
