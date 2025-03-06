<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOrderConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $transaction_id;
    public $amount;
    public $tracking_details;
    public $products;
    public $to_address;

    /**
     * Create a new message instance.
     */
    public function __construct($transaction_id, $amount, $tracking_details, $products, $to_address)
    {
        $this->transaction_id = $transaction_id;
        $this->amount = $amount;
        $this->tracking_details = $tracking_details;
        $this->products = $products;
        $this->to_address = $to_address;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Order Confirmation - A New Order Has Been Placed')
                    ->view('emails.order_confirmation')
                    ->with([
                        'transaction_id' => $this->transaction_id,
                        'amount' => $this->amount,
                        'tracking_details' => $this->tracking_details,
                        'products' => $this->products,
                        'to_address' => $this->to_address,
                    ]);
    }
}
