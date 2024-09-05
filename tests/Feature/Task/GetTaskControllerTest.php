<?php

namespace Tests\Feature;

use App\Repositories\RepoService;
use Tests\TestCase;

class GetTaskControllerTest extends TestCase
{
    public function testGetTaskEndpointReturnsSuccessfulResponse(): void
    {
        $response = $this->get("/api/tasks/{$this->task->id}");

        $response->assertOk();
        $response->assertExactJson([
            'success' => true,
            'data' => [
                'id' => $this->task->id,
                'title' => 'Test Task',
                'description' => 'This is a test task',
                'status' => 'pending',
                'priority' => 'low',
                'due_date' => '2023-04-01',
            ],
        ]);
    }
}
