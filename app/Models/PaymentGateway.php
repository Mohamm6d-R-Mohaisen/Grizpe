<?php

namespace App\Models;

use App\Http\Resources\Admin\PaymentGatewayResource;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable as Trans;
use Astrotomic\Translatable\Contracts\Translatable;

class PaymentGateway extends Model implements Translatable
{
    use HasFactory, Trans, ModelTrait;

    public $table = 'payment_gateways';
    public $resource = PaymentGatewayResource::class;
    public $translatedAttributes = ['name', 'description'];
    public $translatedForeignKey = 'payment_gateway_id';

    protected $fillable = [
        'credentials',
        'status',
    ];

    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->whereTranslationLike('name', 'LIKE', '%' . $search . '%');
        }
        return $query;
    }
 
}
