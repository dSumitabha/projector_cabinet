<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectorMakeNotFound extends Mailable
{
    use Queueable, SerializesModels;

    public $projectorMake;

    /**
     * Create a new message instance.
     */
    public function __construct($projectorMake)
    {
        $this->projectorMake = $projectorMake;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Projector Make Inquiry')
                    ->view('emails.projector_make_not_found')
                    ->with([
                        'projectorMake' => $this->projectorMake,
                    ]);
    }
}
