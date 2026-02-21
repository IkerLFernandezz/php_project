<?php
declare(strict_types=1);

namespace App\Domain\Student\Columns;

final class StudentMail
{
    private string $mail;

    public function __construct(string $mail)
    {
        $this->mail = $mail;
    }

    public function value(): string
    {
        return $this->mail;
    }
}