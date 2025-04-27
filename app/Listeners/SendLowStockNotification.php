<?php

namespace App\Listeners;

use App\Events\LowStockEvent;
use Illuminate\Support\Facades\Mail;

class SendLowStockNotification
{
    /**
     * Handle the event.
     *
     * @param LowStockEvent $event
     * @return void
     */
    public function handle(LowStockEvent $event)
    {
        $product = $event->product;
        $adminEmail = 'admin@example.com';

        Mail::raw("The stock for product '{$product->name}' (ID: {$product->id}) is running low. Remaining quantity: {$product->inventory->quantity}.", function ($message) use ($adminEmail) {
            $message->to($adminEmail)
                    ->subject('Low Stock Alert');
        });
    }
}
