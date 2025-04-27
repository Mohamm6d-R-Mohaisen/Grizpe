<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCompanyTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipping_company_id',
        'name',
        'locale',
    ];
}
