<?php

namespace App\Actions;

use App\DTOs\ContactUsData;
use Illuminate\Support\Facades\DB;
use App\Mail\ContactUsMailable;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Mail;

class ContactUsAction {
    public function execute(ContactUs $contactUs, ContactUsData $contactUsData):void {
        DB::transaction(function () use ($contactUs, $contactUsData) {
            $contactUs->name = $contactUsData->name;
            $contactUs->email = $contactUsData->email;
            $contactUs->subject = $contactUsData->subject;
            $contactUs->message = $contactUsData->message;
            $contactUs->save();

            // Send email to admin
            Mail::to(config('mail.from.address'))->send(
                new ContactUsMailable(
                    name: $contactUsData->name,
                    email: $contactUsData->email,
                    mailSubject: $contactUsData->subject,
                    message: $contactUsData->message,
                )
            );
        });
    }
}
