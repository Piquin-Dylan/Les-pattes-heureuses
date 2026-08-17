<?php

namespace App\Models;

use App\Enums\MembershipRequestStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'phone',
        'message',
        'availabilities',
        'status',
    ];

    protected $casts = [
        'availabilities' => 'array',
    ];

    public function scopePending($query)
    {
        return $query->where('status', MembershipRequestStatus::Pending->value);
    }
}
