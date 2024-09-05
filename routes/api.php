<?php

use App\Http\Controllers\GetUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task\{
    CreateTaskController,
    GetTaskController,
    GetTaskListController,
    UpdateTaskController,
    DeleteTaskController
};

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('account/profile', GetUserController::class);

    // Tasks
    Route::post('tasks', CreateTaskController::class);
    Route::patch('tasks/{id}', UpdateTaskController::class);
    Route::get('tasks/{id}', GetTaskController::class);
    Route::get('tasks', GetTaskListController::class);
    Route::delete('tasks/{id}', DeleteTaskController::class);

});

require __DIR__.'/auth.php';
