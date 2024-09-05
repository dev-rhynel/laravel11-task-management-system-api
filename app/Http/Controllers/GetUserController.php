<?php

namespace App\Http\Controllers;

use App\Core\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class GetUserController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->user()->latest_key === $request->get('key') && $request->get('key') !== null) {
            return ApiResponse::success('ok');
        }

        return ApiResponse::success(
            new UserResource($request->user()),
            'User retrieved successfully.'
        );
    }
}
