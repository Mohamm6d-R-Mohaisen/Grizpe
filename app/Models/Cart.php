<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, ModelTrait;

    public $table = 'carts';

    protected $fillable = [
        'user_id',
        'total_price',
        'status'
    ];

    public const STATUS = [
        '0' => 'active',
        '1' => 'completed',
        '2' => 'abandoned',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_products', 'cart_id', 'product_id')->withPivot(['quantity','total_price']);
    }

    /**
     * Add a product to a cart and apply any applicable offer.
     */
    function addProductToCart($cart, $product_id, $quantity)
    {
        // البحث عن المنتج والتحقق من وجوده مع العروض
        $product = Product::with(['offers'])->findOrFail($product_id);
        $price = $product->price;
        $current_date = now();

        // حساب الخصم من العروض
        $offer_discount = 0;
        foreach ($product->offers as $offer) {
            if ($offer->status === 'active' && $current_date->between($offer->start_date, $offer->end_date)) {
                if ($offer->discount_type === 'percentage') {
                    $offer_discount = max($offer_discount, $price * ($offer->discount_value / 100));
                } elseif ($offer->discount_type === 'fixed') {
                    $offer_discount = max($offer_discount, $offer->discount_value);
                }
            }
        }

        // حساب السعر النهائي بعد الخصم
        $final_price = $price - $offer_discount;
    
        // التحقق من وجود المنتج مسبقًا في العربة
        $cart_product = $cart->products()->where('product_id', $product_id)->first();
    
        if ($cart_product) {
            // تحديث الكمية والسعر الإجمالي إذا كان المنتج موجودًا
            $new_quantity = $cart_product->pivot->quantity + $quantity;
            $cart->products()->updateExistingPivot($product_id, [
                'quantity' => $new_quantity,
                'price' => $final_price,
                'total_price' => $final_price * $new_quantity,
            ]);
        } else {
            // إضافة المنتج للعربة إذا لم يكن موجودًا
            $cart->products()->attach($product_id, [
                'quantity' => $quantity,
                'price' => $final_price,
                'total_price' => $final_price * $quantity,
            ]);
        }
    
        // تحديث السعر الإجمالي للعربة
        $cart->update(['total_price' => $cart->products->sum('pivot.total_price')]);
        
        // تتم هذه العملية عند اضافة او حذف منتج من السلة
        syncCartWithSession();

        return response()->json(['message' => 'Product added successfully with applied offers and coupons!'], 200);
    }

        /**
     * Remove a product from the cart and update the cart's total price.
     */
    function removeProductFromCart($cart_id, $product_id)
    {
        // البحث عن العربة والتحقق من وجودها
        $cart = self::findOrFail($cart_id);

        // التحقق من وجود المنتج في العربة
        $cart_product = $cart->products()->where('product_id', $product_id)->first();

        if (!$cart_product) {
            return response()->json(['message' => 'Product not found in the cart!'], 404);
        }

        // إزالة المنتج من العربة
        $cart->products()->detach($product_id);

        // تحديث السعر الإجمالي للعربة
        $cart->update(['total_price' => $cart->products->sum('pivot.total_price')]);
        
        // تتم هذه العملية عند اضافة او حذف منتج من السلة
        syncCartWithSession();

        return response()->json(['message' => 'Product removed successfully and cart total updated!'], 200);
    }

    
}
