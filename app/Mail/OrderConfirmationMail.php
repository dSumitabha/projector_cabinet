<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $transaction_id;
    public $amount;
    public $products;
    
    /**
     * Create a new message instance.
     */
    public function __construct($transaction_id, $amount, $products)
    {
        $this->transaction_id = $transaction_id;
        $this->amount = $amount;
        $this->products = $products;

    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Order Placed Successfully')
                    ->view('emails.customer_order_confirmation')
                    ->with([
                        'transaction_id' => $this->transaction_id,
                        'amount' => $this->amount,

                        'products' => $this->products,


                    ]);
    }
}
