<?php
declare(strict_types=1);

namespace App\Domain\Student\Columns;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class StudentDni
{
    #[ORM\Column(type: "string", length: 50)]
    private string $dni;

    public function __construct(string $dni)
    {
        $this->dni = $dni;
    }

    public function value(): string
    {
        return $this->dni;
    }
}