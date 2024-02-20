<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\repositories\Contracts\UserRepositoryInterface;

class UsersController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }
    public function store()
    {
        return response()->json([
            'success' => true,
            'message' => 'کاربر با موفقیت ایجاد شد',
            'data' => [
                'fullName' => 'Amirreza Ebrahimi',
                'email' => 'aabrahimi1718@gmail.com',
                'mobile' => '09358919279',
                'password' => '123456',
            ],
        ])->setStatusCode(201);
    }
}
