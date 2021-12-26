<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SenderEmail extends Mailable {
    use Queueable, SerializesModels;

    public $ObjectRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ObjectRequest) {
        $this->ObjectRequest = $ObjectRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from('info@kavax.co.uk', 'Kavax')
            ->subject('Request Services')
            ->view('mails.project-request');
    }
}
