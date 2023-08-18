<?php

use App\Mail\ContactUsMailable;
use Illuminate\Support\Facades\Mail;

use function Pest\Faker\fake;
use function Pest\Laravel\{postJson};
use function Pest\Laravel\{assertDatabaseHas};

it('should process contact form', function () {
    $response = postJson(route('api.v1.contact-us'), [
        'name' => fake()->name,
        'email' => fake()->freeEmail(),
        'message' => fake()->paragraph,
        'subject' => fake()->sentence
    ]);

    $response->assertStatus(200);
});

it('should not process contact form with empty body', function () {
    $response = postJson(route('api.v1.contact-us'), []);

    $response->assertStatus(422);
});

it('should not process contact form with invalid email', function () {
    $response = postJson(route('api.v1.contact-us'), [
        'name' => fake()->name,
        'email' => 'invalid-email',
        'message' => fake()->paragraph,
        'subject' => fake()->sentence
    ]);

    $response->assertInvalid(['email']);
});

it('should not process contact form with invalid name', function () {
    $response = postJson(route('api.v1.contact-us'), [
        'name' => 'a',
        'email' => fake()->freeEmail(),
        'message' => fake()->paragraph,
        'subject' => fake()->sentence
    ]);

    $response->assertInvalid(['name']);
});

it('should not process contact form with invalid subject', function () {
    $response = postJson(route('api.v1.contact-us'), [
        'name' => fake()->name,
        'email' => fake()->freeEmail(),
        'message' => fake()->paragraph,
        'subject' => 'a'
    ]);

    $response->assertInvalid(['subject']);
});

it('should not process contact form with invalid message', function () {
    $response = postJson(route('api.v1.contact-us'), [
        'name' => fake()->name,
        'email' => fake()->freeEmail(),
        'message' => 'a',
        'subject' => fake()->sentence
    ]);

    $response->assertInvalid(['message']);
});

it('should send store contact us form data', function () {
    $name = fake()->name;
    $email = fake()->freeEmail();
    $message = fake()->paragraph;
    $subject = fake()->sentence;

    $response = postJson(route('api.v1.contact-us'), [
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'message' => $message
    ]);

    $response->assertStatus(200);

    assertDatabaseHas('contact_us', [
        'name' => $name,
        'email' => $email,
        'message' => $message,
        'subject' => $subject,
    ]);
});

it('should send email to admin', function () {
    Mail::fake();

    $name = fake()->name;
    $email = fake()->freeEmail();
    $message = fake()->paragraph;
    $subject = fake()->sentence;

    $response = postJson(route('api.v1.contact-us'), [
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'message' => $message
    ]);

    $response->assertStatus(200);

    Mail::assertSent(ContactUsMailable::class, function ($mail) use ($name, $email, $message, $subject) {
        return $mail->hasTo(config('mail.from.address')) &&
            $mail->hasSubject(config('app.frontend_name') . ": Message from Contact Form") &&
            $mail->name === $name &&
            $mail->email === $email &&
            $mail->message === $message &&
            $mail->mailSubject === $subject;
    });
});

it('should have a default pending status', function () {
    $name = fake()->name;
    $email = fake()->freeEmail();
    $message = fake()->paragraph;
    $subject = fake()->sentence;

    $response = postJson(route('api.v1.contact-us'), [
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'message' => $message
    ]);

    $response->assertStatus(200);

    assertDatabaseHas('contact_us', [
        'status' => 'pending'
    ]);
});

// it('should not process contact form with invalid captcha', function () {
//     $response = postJson(route('api.v1.contact-us'), [
//         'name' => fake()->name,
//         'email' => fake()->freeEmail(),
//         'message' => fake()->paragraph,
//         'subject' => fake()->sentence,
//         'captcha' => 'invalid-captcha'
//     ]);

//     $response->assertInvalid(['captcha']);
// });

// it('should process contact form with valid captcha', function () {
//     $response = postJson(route('api.v1.contact-us'), [
//         'name' => fake()->name,
//         'email' => fake()->freeEmail(),
//         'message' => fake()->paragraph,
//         'subject' => fake()->sentence,
//         'captcha' => 'valid-captcha'
//     ]);

//     $response->assertStatus(200);
// });
