<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckoutService
{
    public function checkout(array $cart_items, $user_id, $shipping_cost = 0, $coupon_id = null)
    {
        DB::beginTransaction();
    
        try {
            $total = 0;
            $subtotal = 0;
            $orderItems = [];
            $discount = 0;
            $coupon_discount = 0;
            $offer_discount = 0;
    
            foreach ($cart_items as $item) {
                $product = Product::findOrFail($item['product_id']);
                $inventory = $product->inventory()->where('product_id', $item['product_id'])->first();
                
                if ($inventory->getStockQuantity() < $item['quantity']) {
                    throw new Exception("Insufficient stock for product ID: {$item['product_id']}");
                }
    
                if ($product->isInOffers()) {
                    $offer_discount += $product->getOfferDiscount();
                }

                // Calculate subtotal and total
                $itemTotal = $product->price * $item['quantity'];
                $subtotal += $itemTotal;
                $total += $itemTotal;
    
                // Add item to order items array
                $orderItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                ];
            }
    
            // Check for coupon and apply discount if exists
            if ($coupon_id) {
                $coupon = Coupon::find($coupon_id);
                if ($coupon) {
                    $coupon_discount = $this->applyCouponDiscount($coupon, $subtotal);
                }
            }
    
            // تطبيق الخصم إن وجد
            $discount = $coupon_discount + $offer_discount;
            $total -= $discount;

            // Create order
            $order = Order::create([
                'user_id' => $user_id,
                'coupon_id' => $coupon_id,
                'subtotal' => $subtotal, // total before discount
                'discount' => $discount, // coupon discount + offer discount
                'shipping_cost' => $shipping_cost,
                'total' => $total + $shipping_cost,
                'status' => 'pending',
            ]);

            // إضافة العناصر إلى جدول order_products
            foreach ($orderItems as $orderItem) {
                $order->products()->attach($orderItem['product_id'], [
                    'quantity' => $orderItem['quantity'],
                    'price' => $orderItem['price'],
                    'total' => $orderItem['price'] * $orderItem['quantity'],
                ]);
            }

            DB::commit();
            
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Applies coupon discount to the given subtotal.
     *
     * @param Coupon $coupon
     * @param float $subtotal
     * @return float
     */
    private function applyCouponDiscount($coupon, $subtotal)
    {
        // Apply coupon discount logic, for example:
        if ($coupon->discount_type == 'percentage') {
            return ($coupon->discount_value / 100) * $subtotal;
        } elseif ($coupon->discount_type == 'fixed') {
            return $coupon->discount_value;
        }
    
        return 0;
    }
    
}
