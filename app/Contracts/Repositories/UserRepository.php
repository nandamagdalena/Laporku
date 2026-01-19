<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function create(array $data): User
    {
        return $this->model->create($data);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }
}
