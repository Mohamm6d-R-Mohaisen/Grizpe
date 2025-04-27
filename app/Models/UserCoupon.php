<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model
{
    use HasFactory, ModelTrait;

    public $table = 'user_coupon';

    protected $fillable = [
        'user_id',
        'coupon_id',
    ];

    protected $appends = [
        'date'
    ];

    // public function activateUserCoupon($coupon, $user_id, $total_price, $activate)
    // {
    //     $data = [];
    //     $used_number = UserCoupon::where('coupon_id', $coupon->id)->where('user_id', $user_id)->where('used', 1)->get();
    //     // check the current user is allowed to use this coupon 
    //     if ($used_number->count() == 0) {
    //         $used_time = UserCoupon::where('coupon_id', $coupon->id)->get();
    //         // check how many used for the current user
    //         if ($coupon->uses_time >= $used_time->count()) {
    //             // check if fixed or percentage. percentage:0 
    //             if ($coupon->discount_type == 'percentage') {
    //                 $percentage = $coupon->amount / 100;
    //                 $data['discount'] = round($total_price * $percentage, 2);
    //                 $data['total'] = round($total_price - $data['discount'], 2);
    //                 $data['message'] = 'تم تطبيق الخصم';
    //             } else {
    //                 $data['discount']  = $coupon->amount;
    //                 $data['total'] = round($total_price - $data['discount'], 2);
    //                 $data['message'] = 'تم تطبيق الخصم';
    //             }
    //             if($activate == true){
    //                 UserCoupon::create([
    //                     'user_id'   => $user_id,
    //                     'coupon_id' => $coupon->id,
    //                     'used'      => 1
    //                 ]); 
    //             }
                
    //         } else {
    //             $data['message'] = 'uses time is finished ';
    //             $data['discount'] = null;
    //             $data['total'] = null;
    //         }
    //     } else {
    //         $data['message'] = 'This Coupon not Avaliable to You ';
    //         $data['discount'] = null;
    //         $data['total'] = null;
    //     }
        
    //     return $data;
    // }
}
