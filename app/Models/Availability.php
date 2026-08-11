<?php

namespace App\Models;

use App\Enums\DayOfWeek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Availability extends Model
{
    protected $fillable = [
        'user_id',
        'day',
        'morning',
        'afternoon',
        'evening',
    ];

    protected function casts(): array
    {
        return [
            'morning' => 'boolean',
            'afternoon' => 'boolean',
            'evening' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public static function defaultSchedule(): array
    {
        return collect(DayOfWeek::cases())
            ->mapWithKeys(fn (DayOfWeek $day) => [
                $day->value => ['morning' => false, 'afternoon' => false, 'evening' => false],
            ])
            ->toArray();
    }


    public static function scheduleFor(User $user): array
    {
        $schedule = self::defaultSchedule();

        foreach ($user->availabilities as $availability) {
            $schedule[$availability->day] = [
                'morning' => $availability->morning,
                'afternoon' => $availability->afternoon,
                'evening' => $availability->evening,
            ];
        }

        return $schedule;
    }

    public static function saveSchedule(User $user, array $schedule): void
    {
        foreach ($schedule as $day => $periods) {
            self::updateOrCreate(
                ['user_id' => $user->id, 'day' => $day],
                [
                    'morning' => $periods['morning'] ?? false,
                    'afternoon' => $periods['afternoon'] ?? false,
                    'evening' => $periods['evening'] ?? false,
                ]
            );
        }
    }
}
