<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'description', 'photo', 'age'])]
class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'photo',
        'age',
        'sexe',
        'status',
        'species',
        'sex',
        'coat',
        'breed',
        'breed_id',
        'vaccine_id',
        'slug',
    ];


    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    public function breed() : BelongsTo {
        return $this->belongsTo(Breed::class);
    }

    public function vaccine(): BelongsTo
    {
        return $this->belongsTo(Vaccine::class);
    }

    public function adoption() : BelongsTo {
        return $this->belongsTo(Adoption::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', \App\Enums\StatusAnimal::PENDING->value);
    }
}
