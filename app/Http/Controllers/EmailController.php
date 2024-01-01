<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
}
