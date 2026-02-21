<?php
declare(strict_types=1);

namespace App\Domain\Student\Columns;

final class StudentLicense
{
    private string $license;

    public function __construct(string $license)
    {
        $this->license = $license;
    }

    public function value(): string
    {
        return $this->license;
    }
}