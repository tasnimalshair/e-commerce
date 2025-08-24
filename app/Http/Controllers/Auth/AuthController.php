<?php

namespace App\Http\Controllers\Auth;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(StoreUserRequest $request)
    {

        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        // Merge carts if exists
        $cartService = new CartService();
        $cartService->mergeCarts($request);


        $token = $user->createToken('token_0')->plainTextToken;

        $role = Role::where('name', $data['role'])
            ->where('guard_name', 'api')
            ->first();

        if (!$role) {
            return $this->error('Invalid Role', 400);
        }

        $user->assignRole($role);

        return $this->success('Registered Successfully!', [
            'user' =>  new UserResource($user),
            'token' => $token
        ], 201);
    }

    public function login(LoginUserRequest $request)
    {

        if (!Auth::attempt($request->validated())) {
            return $this->error('Unautherized User!', 401);
        }
        $user = Auth::user();
        $token = $user->createToken('token_0')->plainTextToken;

        return $this->success('Logged Successfully!', [
            'user' =>  new UserResource($user),
            'token' => $token
        ], 200);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->successMessage('Logged Out Successfully!', 200);
    }
}
