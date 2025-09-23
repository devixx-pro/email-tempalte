<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        return view('send-email'); // simple page with button
    }

    public function sendTestEmail(Request $request)
    {
        // validate input
        $request->validate([
            'email' => 'required|email',
        ]);

        $recipient = $request->email;

        Mail::to($recipient)->send(new \App\Mail\TestEmail());

        return back()->with('success', "Test email sent successfully to $recipient!");
    }

    public function preview()
    {
        return view('emails.testemail');
    }
}
