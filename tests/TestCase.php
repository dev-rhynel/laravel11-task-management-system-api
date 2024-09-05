<?php

namespace Tests;

use App\Models\User;
use App\Models\Task;
use App\Repositories\RepoService;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    public User $user;
    public Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'email@example.com',
            'password' => 'VQO9F7fdyNwk!',
        ]);

        $this->task = RepoService::task()->create([
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'due_date' => '2023-04-01',
            'status' => 'pending',
            'priority' => 'low',
            'user_id' => $this->user->id,
        ]);

        Passport::actingAs($this->user);
    }
}
