<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Handle contact us form.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ContactUsRequest $request)
    {
        ContactUs::create($request->all());

        // Send email to admin
        // Mail::to(config('mail.from.address'))->send(new ContactUsMail($request->all()));

        return response()->json([
            'message' => 'Thank you for contacting us. We will get back to you soon.'
        ]);
    }
}
