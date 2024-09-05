<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Http\{
    Controllers\Controller,
    Resources\TaskResource,
    Requests\PaginationRequest
};
use App\Repositories\RepoService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetTaskListController extends Controller
{
    public function __invoke(PaginationRequest $request, RepoService $repoService): AnonymousResourceCollection
    {
        $selected = $request->only([
            'sort_by',
            'filters',
            'search',
            'sort_direction',
            'itemsPerPage',
        ]);

        $tasks = $repoService->task()->index($selected, ['user_id' => $request->user()->id]);

        return TaskResource::collection($tasks);
    }
}
