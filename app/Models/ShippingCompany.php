<?php

namespace App\Models;

use App\Http\Resources\Admin\ShippingCompanyResource;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable as Trans;
use Astrotomic\Translatable\Contracts\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingCompany extends Model implements Translatable
{
    use HasFactory, Trans, ModelTrait;

    public $resource = ShippingCompanyResource::class;
    public $translatedAttributes = ['name'];
    public $translationForeignKey = 'shipping_company_id';
    public $translatedLocales = ['en', 'ar'];

    protected $table = 'shipping_companies';
    protected $fillable = [
        'tracking_url', 
        'cost',
        'status'
    ];

    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->whereTranslationLike('name', '%' . $search . '%');
        }
        return $query;
    }
}
