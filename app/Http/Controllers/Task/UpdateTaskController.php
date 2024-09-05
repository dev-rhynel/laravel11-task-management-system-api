<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Http\{
    Controllers\Controller,
    Requests\Task\UpdateTaskRequest,
    Resources\TaskResource
};
use App\Repositories\RepoService;
use App\Core\ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Events\CompletedTask;
use App\Core\Enums\TaskStatusEnum;

class UpdateTaskController extends Controller
{
    public function __invoke(int $taskId, UpdateTaskRequest $request, RepoService $repoService): JsonResponse
    {
        $recentTask = $repoService->task()->findByIdentifier([
             'id' => $taskId,
             'user_id' => $request->user()->id,
         ]);

        $updatedTask = $repoService->task()->update([
            'id' => $taskId,
            'user_id' => $request->user()->id,
        ], $request->validated());


        if ($recentTask->status !== TaskStatusEnum::Completed->value
            && $updatedTask->status === TaskStatusEnum::Completed->value) {
            CompletedTask::dispatch($request->user());
        }

        return ApiResponse::success(
            data: new TaskResource($updatedTask),
            message: 'Task updated successfully',
        );
    }
}
