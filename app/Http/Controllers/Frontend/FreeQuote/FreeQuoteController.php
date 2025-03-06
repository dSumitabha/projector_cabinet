<?php

namespace App\Http\Controllers\Frontend\FreeQuote;

use App\Models\FreeQuote;
use App\Mail\FreeQuoteMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FreeQuoteController extends Controller
{
    public function index()
    {
        return view('contact_us');
    }

    public function submit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',


            'screen_type' => 'required|in:fixed_screen,floor_raising,either_floor_raising_or_fixed_screen',

            // Ensure at least one of projector_make or projector_make_other is provided
            'projector_make' => 'nullable|string|required_without:projector_make_other',
            'projector_make_other' => 'nullable|string|required_without:projector_make',

            // Ensure at least one of projector_model or projector_model_other is provided
            'projector_model' => 'nullable|string|required_without:projector_model_other',
            'projector_model_other' => 'nullable|string|required_without:projector_model',
            // Ensure at least one of channel_brand or channel_brand_other is provided
            'channel_brand' => 'nullable|string|required_without:channel_brand_other',
            'channel_brand_other' => 'nullable|string|required_without:channel_brand',

            // Ensure at least one of channel_model or channel_model_other is provided
            'channel_model' => 'nullable|string|required_without:channel_model_other',
            'channel_model_other' => 'nullable|string|required_without:channel_model',
            // Ensure at least one of ceiling_height or ceiling_height_other is provided
            'ceiling_height' => 'nullable|string|required_without:ceiling_height_other',
            'ceiling_height_other' => 'nullable|string|required_without:ceiling_height',

            // Ensure at least one of screen_size or screen_size_other is provided
            'screen_size' => 'nullable|string|required_without:screen_size_other',
            'screen_size_other' => 'nullable|string|required_without:screen_size',


        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        $quote = new FreeQuote();
        $quote->email = $request->email;
        $quote->first_name = $request->firstName;
        $quote->last_name = $request->lastName;
        $quote->projector_make = $request->projector_make_other ?? $request->projector_make;
        $quote->projector_model = $request->projector_model_other ?? $request->projector_model;
        $quote->channel_brand = $request->channel_brand_other ?? $request->channel_brand;
        $quote->channel_model = $request->channel_model_other ?? $request->channel_model;
        $quote->ceiling_height = $request->ceiling_height_other ?? $request->ceiling_height;
        $quote->screen_size = $request->screen_size_other ?? $request->screen_size;
        $quote->screen_type = $request->input('screen_type');
        $quote->save();

        // ✅ Prepare response first
        $responseContent = json_encode([
            'status' => 200,
            'message' => 'Form submitted successfully!'
        ]);

        // ✅ Check if output buffering is active before calling `ob_end_clean()`
        if (ob_get_level() > 0) {
            ob_end_clean();
        }

        // ✅ Send response & close connection
        header("Content-Type: application/json");
        header("Connection: close");
        header("Content-Length: " . strlen($responseContent));
        echo $responseContent;
        flush();

        // ✅ Allow PHP to continue processing (if FastCGI is available)
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }

        // ✅ Send email after response is returned
        try {
            Mail::to('praveen.matsa@ustprojectorcabinets.com')->send(new FreeQuoteMail($quote->toArray()));
        } catch (\Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
        }
    }
}
