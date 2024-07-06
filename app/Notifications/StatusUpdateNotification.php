<?php   

namespace App\Notifications;

use App\Models\Applicant;
use App\Models\ContentEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusUpdateNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $applicant;
    public $firstName;  

    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
        $this->firstName = $applicant->applicants_personal_information->first_name ?? '';
    }

    public function build()
    {
        $status = $this->applicant->status;
        if ($status === 'Sent') {
            return null;
        }
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
                return $this->sendApprovedEmail();
            default:
                return $this->sendDefaultEmail();
        }
    }
    
    private function sendUnderReviewEmail()
    {
        $underReviewContent = ContentEmail::first()->under_review ?? ''; 

        $applicant = $this->applicant->load('applicants_personal_information');
        $this->firstName = $applicant->applicants_personal_information->first_name ?? '';

        return $this->subject('Real LIFE Scholarship Application')
            ->view('emails.applicant-under-review', [
                'applicant' => $this->applicant,
                'firstName' => $this->firstName,
                'underReviewContent' => $underReviewContent
            ]);
    }
    
    private function sendShortlistedEmail()
    {
        $shortlistedContent = ContentEmail::first()->shortlisted ?? ''; 

        $applicant = $this->applicant->load('applicants_personal_information');
        $firstName = $applicant->applicants_personal_information->first_name ?? '';

        return $this->subject('Real LIFE Scholarship Application')
            ->view('emails.applicant-shortlisted', [
                'applicant' => $this->applicant,
                'firstName' =>$this->firstName,
                'shortlistedContent' => $shortlistedContent
            ]);     
    }

    private function sendForInterviewEmail()
    {
        $interviewContent = ContentEmail::first()->interview ?? ''; 
        $applicant = $this->applicant->load('applicants_personal_information');
        $firstName = $applicant->applicants_personal_information->first_name ?? '';

        return $this->subject('Real LIFE Scholarship Application')
            ->view('emails.applicant-for-interview', [
                'applicant' => $this->applicant,
                'firstName' =>$this->firstName,
                'interviewContent' => $interviewContent
        ]);
    }

    private function sendForHouseVisitationEmail()
    {
        // if ($this->applicant->status === 'Approved') {
        //     return null; 
        // }

        $houseVisitationContent = ContentEmail::first()->house_visitation ?? ''; 
        $applicant = $this->applicant->load('applicants_personal_information');

        $firstName = $applicant->applicants_personal_information->first_name ?? '';
        $lastName = $applicant->applicants_personal_information->last_name ?? '';

        return $this->subject('Real LIFE Scholarship Application')
            ->view('emails.applicant-for-house-visitation', [
                'applicant' => $applicant,
                'firstName' =>$this->firstName,
                'houseVisitationContent' => $houseVisitationContent
            ]);
    }

    private function sendApprovedEmail()
    {
        $approvedContent = ContentEmail::first()->approved ?? ''; 
        $applicant = $this->applicant->load('applicants_personal_information');
        $firstName = $applicant->applicants_personal_information->first_name ?? '';

        return $this->subject('Real LIFE Scholarship Application')
            ->view('emails.applicant-for-approved', [
                'applicant' => $this->applicant,
                'firstName' =>$this->firstName,
                'approvedContent' => $approvedContent
        ]);
    }

    private function sendDefaultEmail()
    {
        $declineContent = ContentEmail::first()->decline ?? ''; 
        $applicant = $this->applicant->load('applicants_personal_information');
        $firstName = $applicant->applicants_personal_information->first_name ?? '';

        return $this->subject('Real LIFE Scholarship Application')
            ->view('emails.applicant-status-update', [
                'applicant' => $applicant,
                'firstName' => $this->firstName,
                'declineContent' => $declineContent
            ]);
            
    }
}