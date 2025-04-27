<?php

namespace App\Models;

use App\Http\Resources\Admin\CouponResource;
use App\Traits\ModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory, ModelTrait;

    public $table = 'coupons';
    public $resource = CouponResource::class;

    protected $fillable = [
        'name',
        'code',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'times_used',
        'usage_limit', 
        'status',
    ];

    /**
     * Check if the coupon is valid.
     */
    public function isValid(): bool
    {
        $now = Carbon::now();

        return $this->status &&
               $now->between($this->start_date, $this->end_date) &&
               ($this->usage_limit === null || $this->times_used < $this->usage_limit);
    }
    
    public const DISCOUNT_TYPES = [
        '0' => 'fixed',
        '1' => 'percentage',
    ];

    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->where('name', '%' . $search . '%');
        }
        return $query;
    }
}
