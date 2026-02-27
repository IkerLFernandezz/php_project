<?php
declare(strict_types=1);

namespace App\Domain\Subject\Columns;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class SubjectId
{
    #[ORM\Column(name: "id", type: "string", length: 36)]
    private string $value;

    public function __construct(string $value)
    {
        $this->value = trim($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}