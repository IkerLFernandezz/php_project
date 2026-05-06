<?php
declare(strict_types=1);

namespace App\Domain\Subject\Columns;

use Doctrine\ORM\Mapping as ORM;
use Exception;

#[ORM\Embeddable]
final class SubjectName
{
    #[ORM\Column(name: "name", type: "string", length: 150)]
    private string $value;

    public function __construct(string $value)
    {
        $value = trim($value);

        if ($value === '') {
            throw new Exception("Subject name cannot be empty");
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}