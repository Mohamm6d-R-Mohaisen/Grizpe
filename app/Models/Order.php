<?php

namespace App\Models;

use App\Http\Resources\Admin\OrderResource;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, ModelTrait;

    public $resource = OrderResource::class;

    protected $fillable = [
        'user_id',
        'coupon_id',
        'subtotal',
        'discount',
        'shipping_cost',
        'total',
        'status',
    ];

    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->whereHas('user', function($query2) use ($search) {
                $query2->where(function($q) use ($search){
                    $q->where(function($r) use ($search){
                        $r->where('first_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $search . '%');
                    });
                });
            });
        };
        
        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')->withPivot('quantity', 'price', 'total');
    }

    public function shipping()
    {
        return $this->hasOne(OrderShipping::class);
    }
}
