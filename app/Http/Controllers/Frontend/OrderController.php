<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CheckoutRequest;
use App\Mail\OrderInvoiceMail;
use App\Models\Attribute;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Variant;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function checkout(CheckoutRequest $request)
    {
        $selectedYear = $request->input('year'); // مثال: 2022
        $selectedStorage = $request->input('memory'); // مثال: 64
        $selectedCondition = $request->input('condition'); // مثال: new

        // $product = Product::findOrFail($request->product_id);
        // $variant = $product->variants()
        // ->whereHas('attributeValues', function ($query) use ($selectedYear, $selectedStorage, $selectedCondition) {
        //     $query->whereIn('slug', [$selectedYear, $selectedStorage, $selectedCondition])
        //         ->whereHas('attribute', function ($q) {
        //             $q->whereIn('slug', ['year', 'memory_size', 'condition']);
        //         });
        // }, '=', 3) 
        // ->first();

        $variant = Variant::where('product_id', $request->product_id)->whereHas('attributeValues', function ($query) use ($selectedYear,$selectedStorage,$selectedCondition) {
                        $query->whereIn('slug', [$selectedYear, $selectedStorage, $selectedCondition]);
                    })->first();
        
        try {
            DB::beginTransaction();
            
            $user = User::where('email', $request->email)->first();
            if(!$user){
                $user = User::create([
                    'first_name' => $request->first_name,
                    'last_name'  => $request->last_name,
                    'phone_code' => '1',
                    'phone' => $request->phone,
                    'email' => $request->email,
                ]);
            }
            
            $order = Order::create([
                'user_id' => $user->id,
                'subtotal' => $variant->price,
                'total' => $variant->price
            ]);

            // حفظ المنتج مع البيانات في جدول order_products
            $order->products()->attach($request->product_id, [
                'variant_id' => $variant->id,
                'quantity'   => 1,
                'price'      => $variant->price,
                'total'      => $variant->price,
            ]);

            // حفظ عنوان الشحن
            $user_address = UserAddress::create([
                'user_id'           => $user->id,
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'email'             => $request->email,
                'phone'             => $request->phone,
                'address'           => $request->address,
                'address_details'   => $request->address_details,
                'city'              => $request->city,
                'state'             => $request->state,
                'postal_code'       => $request->postal_code,
                'preferred_date'    => $request->preferred_date,
                'preferred_time'    => $request->preferred_time,
                'delivery_method'    => $request->delivery_method,
            ]);

            // $attributes = Attribute::whereIn('slug', ['year', 'memory_size', 'condition'])->get();
            $attributes = [
                'year' => $selectedYear,
                'memory_size' => $selectedStorage,
                'condition' => $selectedCondition,
            ];

            Mail::to($order->user->email)->send(
                new OrderInvoiceMail($order, $attributes)
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order saved successfully',
                'data'    => $user_address
            ]);
            // return $this->response_api(400, __('admin.global.payment_failed'), '');
        } catch (Exception $e) {
            DB::rollback();
            return $this->response_api(400, $e->getMessage(), '');
        }
    }
 
}
