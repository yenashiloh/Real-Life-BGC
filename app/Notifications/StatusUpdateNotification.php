<?php   

namespace App\Notifications;

use App\Models\Applicant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusUpdateNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $applicant;

    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }

    public function build()
    {
        $status = $this->applicant->status;

        switch ($status) {
            case 'Under Review':
                return $this->sendUnderReviewEmail();
            case 'Shortlisted':
                return $this->sendShortlistedEmail();
            case 'For Interview':
                return $this->sendForInterviewEmail();
            case 'For House Visitation':
                return $this->sendForHouseVisitationEmail();
            case 'Approved': 
                return null;
            default:
                return $this->sendDefaultEmail();
        }
    }

    private function sendUnderReviewEmail()
    {
        $applicant = $this->applicant->load('applicants_personal_information');
        $firstName = $applicant->applicants_personal_information->first_name ?? '';

        return $this->subject('Real LIFE Scholarship Application')
            ->view('emails.applicant-under-review', ['
            applicant' => $this->applicant,
            'firstName' =>$firstName
        ]);
    }

    private function sendShortlistedEmail()
    {
        $applicant = $this->applicant->load('applicants_personal_information');
        $firstName = $applicant->applicants_personal_information->first_name ?? '';

        return $this->subject('Real LIFE Scholarship Application')
            ->view('emails.applicant-shortlisted', [
                'applicant' => $this->applicant,
                'firstName' =>$firstName
            ]);
                
    }

    private function sendForInterviewEmail()
    {
        $applicant = $this->applicant->load('applicants_personal_information');
        $firstName = $applicant->applicants_personal_information->first_name ?? '';

        return $this->subject('Real LIFE Scholarship Application')
            ->view('emails.applicant-for-interview', [
                'applicant' => $this->applicant,
                'firstName' =>$firstName
        ]);
    }

    private function sendForHouseVisitationEmail()
    {
        if ($this->applicant->status === 'Approved') {
            return null; 
        }

        $applicant = $this->applicant->load('applicants_personal_information');

        $firstName = $applicant->applicants_personal_information->first_name ?? '';
        $lastName = $applicant->applicants_personal_information->last_name ?? '';

        return $this->subject('Real LIFE Scholarship Application')
            ->view('emails.applicant-for-house-visitation', [
                'applicant' => $applicant,
                'firstName' => $firstName
            ]);
    }


    private function sendDefaultEmail()
    {
        $applicant = $this->applicant->load('applicants_personal_information');
        $firstName = $applicant->applicants_personal_information->first_name ?? '';

        return $this->subject('Real LIFE Scholarship Application')
            ->view('emails.applicant-status-update', [
                'applicant' => $applicant,
                'firstName' => $firstName
            ]);
            
    }
}