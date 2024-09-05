<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Http\{
    Controllers\Controller,
    Requests\Task\CreateTaskRequest,
    Resources\TaskResource
};
use App\Repositories\RepoService;
use App\Core\ApiResponse;
use Illuminate\Http\JsonResponse;

class CreateTaskController extends Controller
{
    public function __invoke(CreateTaskRequest $request, RepoService $repoService): JsonResponse
    {
        $task = $repoService->task()->create([
                ...$request->all(),
                'user_id' => $request->user()->id,
            ]);

        return ApiResponse::success(data: new TaskResource($task), message: 'Task created successfully', code: 201);
    }
}
