<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $email, $user_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $user_id)
    {
        $this->email = $email;
        $this->user_id = $user_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reset_password')
            ->with('email', $this->email)
            ->with('user_id', $this->user_id);
    }
}
