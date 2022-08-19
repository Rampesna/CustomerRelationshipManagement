<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Requests\Api\Authentication\LoginRequest;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function login(LoginRequest $request)
    {
        if (!$user = $this->userService->getByEmail($request->email)) return $this->error('User not found', 404);
        if (!Hash::check($request->password, $user->password)) return $this->error('Password is incorrect', 401);
        return $this->success('User logged in successfully', [
            'token' => $this->userService->generateSanctumToken($user)
        ]);
    }
}
