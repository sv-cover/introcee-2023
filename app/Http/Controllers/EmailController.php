<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class EmailController extends Controller
{
    public function sendTestMail()
    {
        $testMailData = [
            'title' => 'Test Email From IntroCee',
            'body' => 'This is the body of test email.',
            'buttonlink' => 'https://fabiancuza.com',
            'buttontext' => 'Go to Fabi'
        ];

        Mail::to('fabian.cuza@gmail.com')->send(new SendMail($testMailData));

        dd('Success! Email has been sent successfully.');
    }
}
