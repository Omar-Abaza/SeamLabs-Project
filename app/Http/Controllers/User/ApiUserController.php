<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUser;

class ApiUserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function allUser()
    {
        return $this->userService->all();
    }

    public function showUser($id)
    {
        return $this->userService->show((int)$id) ?? response()->json(["status" => "User Not Found"], Response::HTTP_NOT_FOUND);
    }

    public function createUser(CreateUser $request)
    {
        return $this->userService->create($request);
    }

    public function updateUser(CreateUser $request, $id)
    {
        return $this->userService->update($request, (int)$id);
    }

    public function deleteUser($id)
    {
        return $this->userService->delete((int)$id);
    }
}