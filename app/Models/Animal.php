<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

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
    ];
    public $timestamps = false;
}
