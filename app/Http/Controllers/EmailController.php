<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;


class EmailController extends Controller
{
    public function sendEmail(){
        Mail::to('developers@gmail.com')->send(new TestMail());
    }
}
