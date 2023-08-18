<?php

namespace App\Enums;

enum ContactUsStatus: string {
    case PENDING = 'pending';
    case VIEWED = 'viewed';
    case ANSWERED = 'answered';
}
