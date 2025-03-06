<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FreeQuoteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $quoteData;

    public function __construct($quoteData)
    {
        $this->quoteData = $quoteData;
    }

    public function build()
    {
        return $this->subject('New Free Quote Submission')
                    ->view('emails.free_quote')
                    ->with('quoteData', $this->quoteData);
    }
}
