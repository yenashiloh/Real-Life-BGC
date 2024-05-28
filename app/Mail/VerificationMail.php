<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Applicant;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant; // Declare the public variable

    /**
     * Create a new message instance.
     *
     * @param Applicant $applicant
     */
    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant; // Assign the applicant to the public variable
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.verification') // Pass the applicant to the view
                    ->subject('Email Verification');
    }

}
