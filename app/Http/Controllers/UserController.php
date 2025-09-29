<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        #check jika username telah digunakan
        if (User::where('username', $data['username'])->exists()) {
            throw new HttpResponseException(response([
                'errors' => [
                    'username' => [
                        'The username already exists.'
                    ]
                ]
            ],400));
        }

        $user = new User($data);
        $user->password = bcrypt($data['password']);
        $user->save();

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        $user = User::find($id);

        if(!$user) {
            return response()->json([
                'msg' => 'User not found.'
            ], 404);
        }

        if($request->has('username')) {
            $user->username = $request->username;
        }

        if($request->filled('password')) {
            $user->password = bcrypt($request['password']);
        }

        if($request->has('name')) {
            $user->name = $request['name'];
        }

        $user->save();

        //update data
        return response()->json([
            'msg' => 'User update successfully.',
            'data' => $user,
        ], 200);
    }
}
