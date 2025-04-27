<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $attributes;

    public function __construct($order, $attributes)
    {
        $this->order = $order;
        $this->attributes = $attributes;
    }

    public function build()
    {
        return $this->subject('Invoice for Your Order #' . $this->order->id)
                    ->view('mail.order-invoice');
    }
}