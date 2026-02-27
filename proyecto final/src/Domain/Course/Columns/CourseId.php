<?php
declare(strict_types=1);

namespace App\Domain\Course\Columns;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class CourseId
{
    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36)]
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