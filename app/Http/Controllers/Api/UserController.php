<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function getAll()
    {
        return $this->userService->getAll();
    }
}
