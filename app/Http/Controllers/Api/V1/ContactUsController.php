<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\ContactUsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;

class ContactUsController extends Controller
{
    /**
     * Handle contact us form.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ContactUsRequest $request, ContactUsAction $contactUsAction)
    {
        $contactUsAction->execute(
            new \App\Models\ContactUs(),
            new \App\DTOs\ContactUsData( ... $request->validated())
        );

        return response()->json([
            'message' => 'Your message has been sent successfully.',
        ]);
    }
}
