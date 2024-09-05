<?php

namespace App\Http\Controllers\Task;

use App\Http\{
    Controllers\Controller,
    Resources\TaskResource
};
use App\Repositories\RepoService;
use App\Core\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetTaskController extends Controller
{
    public function __invoke(int $taskId, RepoService $repoService, Request $request): JsonResponse
    {
        $task = $repoService->task()->findByIdentifier(['id' => $taskId, 'user_id' =>  $request->user()->id]);

        return ApiResponse::success(new TaskResource($task));
    }
}
