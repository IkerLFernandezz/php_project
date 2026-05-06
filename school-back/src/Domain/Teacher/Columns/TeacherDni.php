<?php
declare(strict_types=1);

namespace App\Domain\Teacher\Columns;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class TeacherDni
{
    #[ORM\Column(type: "string", length: 255)]
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