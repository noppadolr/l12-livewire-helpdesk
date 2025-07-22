<?php

namespace App\Enums\Enums;

enum Role:string
{
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case USER = 'user';
}
