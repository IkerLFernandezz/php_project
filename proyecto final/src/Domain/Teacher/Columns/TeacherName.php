<?php
declare(strict_types=1);

namespace App\Domain\Teacher\Columns;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class TeacherName
{
    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function value(): string
    {
        return $this->name;
    }
}