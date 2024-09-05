<?php

namespace App\Repositories;

use App\Repositories\TaskRepository;
use App\Interfaces\TaskRepositoryInterface;
use App\Repositories\UserRepository;
use App\Interfaces\UserRepositoryInterface;

class RepoService
{
    public static function user(): UserRepositoryInterface
    {
        return new UserRepository();
    }

    public static function task(): TaskRepositoryInterface
    {
        return new TaskRepository();
    }
}
