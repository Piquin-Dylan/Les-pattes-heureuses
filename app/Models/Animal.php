<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'description', 'photo', 'age'])]
class Animal extends Model
{
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
    public $timestamps = false;


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
}
