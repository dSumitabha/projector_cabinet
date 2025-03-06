<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emaill' => 'required|email|unique:subscribes,email',
        ], [
            'emaill.unique' => 'you are alredy suscribed user',
            'emaill.email' => 'please enter valid email',
            'emaill.required' => 'The email field is required',


        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        $quote = new Subscribe();
        $quote->email = $request->emaill;
        $quote->save();

        return response()->json(['status' => 200, 'message' => 'Your Subscription successfully!']);
    }

    public function aboutUs(){
        return view('frontend.about_us');
    }

    public function faqPage(){
        $faqs = Faq::where('type', 'general')->orWhere('type', 'common')->get();
        return view('frontend.faq', compact('faqs'));

    }
    public function contacts(){
        return view('frontend.contacts');
    }

    public function privecyPolicy(){
        return view('frontend.privecy_policy');
    }

    public function termsCondition(){
        return view('frontend.terms_and_condition');
    }
}
