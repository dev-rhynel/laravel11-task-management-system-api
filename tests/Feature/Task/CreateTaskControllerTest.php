<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateTaskControllerTest extends TestCase
{
    public function testCreateTaskEndpointReturnsUnsuccessfulResponse(): void
    {
        $response = $this->postJson('/api/tasks', [
                    'title' => 'Test Task',
                    'description' => 'This is a test task',
                    'due_date' => '2023-04-01',
                    'status' => 'pending',
                    'priority' => 'low',
                    'user_id' => $this->user->id,
                ]);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'data' => [
                'id' => $response->json('data.id'),
                'title' => 'Test Task',
                'description' => 'This is a test task',
                'status' => 'pending',
            ],
            'message' => 'Task created successfully',
        ]);
    }
}
