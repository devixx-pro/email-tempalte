<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        return view('send-email'); // simple page with button
    }

    public function sendTestEmail()
    {
        Mail::to('diwakar.orion@gmail.com')->send(new TestEmail());

        return back()->with('success', 'Test email sent successfully!');
    }
}
