<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $admin_mail;
    public $transaction_id;
    public $amount;
    public $tracking_details;
    public $products;

    /**
     * Create a new job instance.
     */
    public function __construct($admin_mail, $transaction_id, $amount, $tracking_details,$products)
    {
        $this->admin_mail = $admin_mail;
        $this->transaction_id = $transaction_id;
        $this->amount = $amount;
        $this->tracking_details = $tracking_details;
        $this->products = $products;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::send('emails.order_confirmation', [
            'transaction_id' => $this->transaction_id,
            'amount' => $this->amount,
            'tracking_details' => $this->tracking_details,
            'products' => $this->products,
        ], function ($message) {
            $message->to($this->admin_mail)
                ->subject('Order Confirmation - Your Payment is Successful');
        });
    }
}

