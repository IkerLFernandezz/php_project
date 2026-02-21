<?php
declare(strict_types=1);

namespace App\Domain\Teacher;

use App\Domain\Teacher\Columns\TeacherId;
use App\Domain\Teacher\Columns\TeacherName;
use App\Domain\Teacher\Columns\TeacherSurname;

final class Teacher
{
    private TeacherId $id;
    private TeacherName $name;
    private TeacherSurname $surname;

    public function __construct(TeacherId $id, TeacherName $name, TeacherSurna  me $surname)
    {

    }
}