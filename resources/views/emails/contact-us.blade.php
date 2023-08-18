<x-mail::message>
## New Message Contact Form

**NAME:** {{ $name }} \
**EMAIL ADDRESS:** {{ $email }} \
**SUBJECT:** {{ $mailSubject }} \
**MESSAGE:** \
{{ $message }}

Thanks,<br>
{{ config('app.frontend_name') }}
</x-mail::message>
