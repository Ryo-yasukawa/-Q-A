<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class TestMailController extends Controller
{
    public function sendTest()
    {
         Mail::to('example@example.com')
            ->send(new TestMail());

        return '送信完了';
    }

}
