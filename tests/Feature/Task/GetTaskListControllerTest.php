<?php

namespace Tests\Feature;

use App\Repositories\RepoService;
use Tests\TestCase;

class GetTaskListControllerTest extends TestCase
{
    public function testGetTaskListEndpointReturnsSuccessfulResponse(): void
    {
        $taskListResponse = $this->get('/api/tasks');

        $taskListResponse->assertOk();
        $taskListResponse->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'status',
                    'priority',
                    'due_date',
                ],
            ],
            'pagination' => [
                'currentPage',
                'from',
                'lastPage',
                'perPage',
                'to',
                'total',
            ]
        ]);
        $this->assertCount(1, $taskListResponse->json('data'));
    }
}
