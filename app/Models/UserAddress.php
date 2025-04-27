<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        // 'delivery_method',
        'first_name',
        'last_name',
        'address',
        'address_details',
        'city',
        'state',
        'country',
        'postal_code',
        'phone',
        'is_archived',
        'preferred_date',
        'preferred_time',
        'delivery_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
