<?php

namespace Tests\Feature;

use Tests\TestCase;

class DeleteTaskControllerTest extends TestCase
{
    public function testDeleteTaskEndpointReturnsUnsuccessfulResponse(): void
    {
        $response = $this->delete("/api/tasks/{$this->task->id}");

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'message' => 'Task deleted successfully',
        ]);
    }
}
