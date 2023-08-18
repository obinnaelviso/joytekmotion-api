<?php

namespace App\DTOs;

use App\Enums\ContactUsStatus;

class ContactUsData
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $subject,
        public readonly string $message,
        public readonly string $status = ContactUsStatus::PENDING->value,
        public readonly ?int $id = null,
    ) {
    }
}
