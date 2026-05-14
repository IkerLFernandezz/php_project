<?php
declare(strict_types=1);

namespace App\Infrastructure\Auth;

final class AuthenticatedUser
{
    public function __construct(
        public readonly string $googleId,
        public readonly string $email,
        public readonly string $name,
    ) {
    }
}