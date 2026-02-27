<?php
declare(strict_types=1);

namespace App\Domain\Student\Columns;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class StudentMail
{
    #[ORM\Column(type: "string", length: 255)]
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