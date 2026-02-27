<?php
declare(strict_types=1);

namespace App\Domain\Teacher\Columns;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class TeacherSurname
{
    #[ORM\Column(type: "string", length: 255)]
    private string $surname;

    public function __construct(string $surname)
    {
        $this->surname = $surname;
    }

    public function value(): string
    {
        return $this->surname;
    }
}