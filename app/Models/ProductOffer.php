<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    use HasFactory, ModelTrait;

    protected $fillable = [
        'offer_id',
        'product_id',
        'discount',
    ];
}
