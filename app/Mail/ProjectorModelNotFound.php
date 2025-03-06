<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectorModelNotFound extends Mailable
{
    use Queueable, SerializesModels;

    public $projectorMake;
    public $projectorModel;

    /**
     * Create a new message instance.
     */
    public function __construct($projectorMake, $projectorModel)
    {
        $this->projectorMake = $projectorMake;
        $this->projectorModel = $projectorModel;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Projector Model Inquiry')
                    ->view('emails.projector_model_not_found')
                    ->with([
                        'projectorMake' => $this->projectorMake,
                        'projectorModel' => $this->projectorModel,
                    ]);
    }
}
