<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\LoginUser;
use App\Http\Requests\CreateUser;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function register(CreateUser $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $access_token = Str::random(64);
        $user->access_token = $access_token;
        $user->birthDay = $request->birthDay;
        $user->phone = $request->phone;
        $user->save();

        return response()->json([
            "status" => "registered successfully",
            "access_token" => $access_token
        ], Response::HTTP_OK);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function login(LoginUser $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user = User::where('email', $request->email)->where('name', $request->name)->first();

        if ($user !== null ) {
            $passwordCheck = Hash::check($request->password, $user->password);
            if ($passwordCheck) {
                $access_token = Str::random(64);
                $user->update([
                    "access_token" => $access_token
                ]);
                return response()->json([
                    "status" => "login successfully",
                    "access_token" => $access_token
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    "status" => "credentials not correct"
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        } else {
            return response()->json([
                "status" => "credentials not correct"
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function logout(Request $request)
    {
        $access_token = $request->header("access_token");
        $user = User::where("access_token", "=", $access_token)->first();;
        if ($user !== null && $access_token !== null) {
            $user->update([
            "access_token" =>null
        ]);
        return response()->json([
            "msg" => "logout successfully",
        ], Response::HTTP_OK);
    } else {
            return response()->json([
                "status" => "access_token not correct"
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
}