<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log; 

class IncompleteRequirementsNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $uncheckedDocumentTypes;
    public $firstName;
    public $subject;

    public function __construct($uncheckedDocumentTypes, $firstName, $subject)
    {
        $this->uncheckedDocumentTypes = $uncheckedDocumentTypes;
        $this->firstName = $firstName;
        $this->subject = $subject;
    }

    public function build()
    {
        Log::info('Building email with firstName: ' . $this->firstName . ' and uncheckedDocumentTypes: ' . json_encode($this->uncheckedDocumentTypes));
    
        return $this->view('emails.document_notification')
                    ->with([
                        'firstName' => $this->firstName,
                        'uncheckedDocumentTypes' => $this->uncheckedDocumentTypes,
                    ])
                    ->subject($this->subject);
    }
    
    
}
