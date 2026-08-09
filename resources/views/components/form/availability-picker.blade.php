@props([
    'schedule' => [],
    'name' => 'availabilities',
    'readonly' => false,
])

@php
    $periods = [
        'morning' => 'Matin',
        'afternoon' => 'Après-midi',
        'evening' => 'Soir',
    ];
@endphp

<div class="overflow-x-auto">
    <table class="w-full min-w-[480px] border-separate border-spacing-y-2 text-left">
        <thead>
            <tr class="text-sm text-gray-500">
                <th class="pb-2 pl-1 font-semibold">
                    Jour
                </th>
                @foreach($periods as $periodLabel)
                    <th class="pb-2 text-center font-semibold">
                        {{ $periodLabel }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach(\App\Enums\DayOfWeek::cases() as $day)
                <tr class="rounded-2xl border border-gray-200 bg-white">
                    <td class="rounded-l-2xl border-y border-l border-gray-200 px-4 py-3 font-semibold text-[#2F2F2F]">
                        {{ $day->label() }}
                    </td>

                    @foreach($periods as $period => $periodLabel)
                        <td class="border-y border-gray-200 px-4 py-3 text-center last:rounded-r-2xl last:border-r">
                            @if($readonly)
                                @if($schedule[$day->value][$period] ?? false)
                                    <span
                                        class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#C67C47] text-xs font-bold text-white"
                                        title="{{ $day->label() }} - {{ $periodLabel }} disponible">
                                        &#10003;
                                    </span>
                                @else
                                    <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-gray-300">
                                        &ndash;
                                    </span>
                                @endif
                            @else
                                <input
                                    type="checkbox"
                                    wire:model.live="{{ $name }}.{{ $day->value }}.{{ $period }}"
                                    aria-label="{{ $day->label() }} - {{ $periodLabel }}"
                                    class="h-5 w-5 cursor-pointer rounded border-[#E7D7C7] text-[#C67C47] focus:ring-4 focus:ring-[#C67C47]/20">
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
