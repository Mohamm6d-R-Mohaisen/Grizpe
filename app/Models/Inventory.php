<?php

namespace App\Models;

use App\Events\LowStockEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $fillable = [
        'quantity',
        'inventoryable_id',
        'inventoryable_type',
    ];

    public function inventoryable()
    {
        return $this->morphTo();
    }

    public function addStock(int $amount): bool
    {
        if ($amount <= 0) return false;
        $this->quantity += $amount;
        return $this->save();
    }

    public function deductStock(int $amount): bool
    {
        if ($amount <= 0 || $this->quantity < $amount) {
            throw new \Exception('Invalid operation');
        }

        $this->quantity -= $amount;
        $this->save();

        if ($this->quantity < 1) {
            event(new LowStockEvent($this->inventoryable));
        }

        return true;
    }

    /**
     * Check if there is enough stock for a specific amount.
     *
     * Ex: 
     *    $inventory = Inventory::find(1);
     *    $inventory->hasEnoughStock(10); // التحقق من وجود 10 وحدات
     * @param int $amount
     * @return bool
     */
    public function hasEnoughStock(int $amount): bool
    {
        return $this->quantity >= $amount;
    }

    /**
     * Get the current stock quantity.
     * Ex: 
     *    $inventory = Inventory::find(1);
     *    $inventory->getStockQuantity(); // الحصول على الكمية الحالية
     * @return int
     */
    public function getStockQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Restock to a specific quantity.
     * Ex: 
     *    $inventory = Inventory::find(1);
     *    $inventory->restockTo(100); // تحديث الكمية إلى رقم محدد
     * @param int $newQuantity
     * @return bool
     */
    public function restockTo(int $newQuantity): bool
    {
        if ($newQuantity < 0) {
            return false; // Invalid quantity
        }

        $this->quantity = $newQuantity;
        return $this->save();
    }

    /**
     * Check if the inventory is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->quantity <= 0;
    }

    /**
     * Get the stock status as a human-readable string.
     * Ex: 
     *    $inventory = Inventory::find(1);
     *    $inventory->stockStatus(); // التحقق من حالة المخزون In stock, Low stock, أو Out of stock
     * @return string
     */
    public function stockStatus(): string
    {
        if ($this->isEmpty()) {
            return 'Out of stock';
        } elseif ($this->quantity < 10) {
            return 'Low stock';
        } else {
            return 'In stock';
        }

        if ($this->inventoryable instanceof Product) {
            $status .= " (Product: {$this->inventoryable->name})";
        } elseif ($this->inventoryable instanceof Variant) {
            $status .= " (Variant: {$this->inventoryable->sku})";
        }
    }

    
}
