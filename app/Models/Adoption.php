<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'phone',
        'message',
        'animal_id',
        'status',
        'notified_at',
    ];

    protected function casts(): array
    {
        return [
            'notified_at' => 'datetime',
        ];
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', \App\Enums\AdoptionStatus::Pending->value);
    }
    
    public function scopeAwaitingNotification($query)
    {
        return $query
            ->where('status', \App\Enums\AdoptionStatus::InProgress->value)
            ->whereNull('notified_at');
    }
}
