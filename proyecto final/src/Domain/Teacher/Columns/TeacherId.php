<?php
declare(strict_types=1);

namespace App\Domain\Teacher\Columns;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class TeacherId
{
    #[ORM\Column(name: "id", type: "string", length: 36)]
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function value(): string
    {
        return $this->id;
    }
}