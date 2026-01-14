<?php

namespace App\Domain\User;
use App\Domain\User\UserId;
use App\Domain\User\User;

interface IUserRepository{
    public function saveUser(User $book): void;

    public function findById(UserId $id): ?User;

    public function findAll(): array;

}