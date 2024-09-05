<?php

namespace App\Http\Controllers\Task;

use App\Http\{
    Controllers\Controller,
};
use App\Repositories\RepoService;
use App\Core\ApiResponse;
use Illuminate\Http\Request;

class DeleteTaskController extends Controller
{
    public function __invoke(int $taskId, Request $request, RepoService $repoService)
    {
        $repoService->task()->delete(['user_id' => $request->user()->id, 'id' => $taskId], $taskId);

        return ApiResponse::success(message: 'Task deleted successfully', code: 201);

    }
}
