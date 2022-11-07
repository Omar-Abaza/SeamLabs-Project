<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\LoginUser;
use App\Http\Requests\CreateUser;
use App\Http\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(CreateUser $request)
    {
        return $this->authService->register($request);
    }

    public function login(LoginUser $request)
    {
        return $this->authService->login($request) ?? response()->json(["status" => "User Not Found"], Response::HTTP_NOT_FOUND);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request) ?? response()->json(["status" => "User Not Found"], Response::HTTP_NOT_FOUND);
    }

}
