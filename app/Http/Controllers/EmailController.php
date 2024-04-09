<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\Announcement; 
use App\Models\Applicant;
use App\Models\ApplicantsAcademicInformation;
use App\Models\ApplicantsPersonalInformation;
use Illuminate\Support\Facades\DB; 
use App\Notifications\StatusUpdateNotification; 
use App\Models\ApplicantsAcademicInformationChoice;
use App\Models\ApplicantsAcademicInformationGrade;
use App\Models\Member;
use App\Models\Notification;
use App\Models\Requirement;
use App\Models\ContentEmail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'content' => 'required',
        ]);
    
        $data = [
            'subject' => $request->subject,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'content' => $request->content
        ];
    
        Mail::send('email-template', $data, function ($message) use ($data) {
            Log::info('Sender Name (Before Sending Email): ' . $data['first_name'] . ' ' . $data['last_name']);
            Log::info('Sender Email (Before Sending Email): ' . $data['email']);
        
            $senderName = $data['first_name'] . ' ' . $data['last_name'];
            
            $message->to('reallifebgc@gmail.com')
                ->subject($data['subject'])
                ->from($data['email'], $senderName)
                ->replyTo($data['email'], $senderName);
        });
        
        
        return back()->with(['message' => 'Your message has been sent. Thank you!']);
    }    

      //email page
      public function emailShow()
      {
          $title = 'Email';
          
          // Fetch the latest content from the database
          $contentEmail = ContentEmail::first();
          $under_review_data = $contentEmail ? $contentEmail->under_review : '';
          
          return view('admin.email.email', compact('title', 'under_review_data'));
      }
      

      public function saveUnderReviewContent(Request $request)
      {
          $validator = Validator::make($request->all(), [
              'under_review' => 'required', // aligning with the name attribute in the form
          ]);
      
          if ($validator->fails()) {
              return redirect()->back()->withErrors($validator)->withInput();
          }
      
          // Check if there is an existing record in the database
          $content_email = ContentEmail::first();
      
          if ($content_email) {
              // Update the existing record
              $content_email->under_review = $request->input('under_review');
              $content_email->save();
          } else {
              // Create a new record
              $content_email = new ContentEmail();
              $content_email->under_review = $request->input('under_review');
              $content_email->save();
          }
      
          $request->session()->flash('success', 'Under Review Content Saved Successfully!');
          // Pass the submitted data back to the view
          return redirect()->route('admin.email.email')->with('under_review_data', $request->input('under_review'));
      }
      
      
  }