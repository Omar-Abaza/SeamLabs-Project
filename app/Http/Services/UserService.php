<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CreateUser;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Model::all
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function create(CreateUser $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->birthDay = $request->birthDay;
        $user->phone = $request->phone;
        $access_token = Str::random(64);
        $user->access_token = $access_token;
        $user->save();

        return response()->json([
            "status" => "inserted successfully",
        ], Response::HTTP_CREATED);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function update(CreateUser $request, $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return response()->json([
                "status" => "User not found"
            ],  Response::HTTP_NOT_FOUND);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->birthDay = $request->birthDay;
        $user->phone = $request->phone;
        $user->save();

        return response()->json([
            "status" => "updated successfully",
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function delete($id)
    {
        $user = User::find($id);
        if ($user == null) {
        return response()->json([
            "status" => 'User does not exist'
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->delete();

        return response()->json([
            "status" => "deleted successfully",
        ], Response::HTTP_OK);
    }
}
