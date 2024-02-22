<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\Contracts\APIController;
use App\repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UsersController extends APIController
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'fullName' => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string',
            'password' => 'required',
        ]);
        $this->userRepository->create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => app('hash')->make($request->password),
        ]);

        return $this->responseCreated('کاربر با موفقیت ایجاد شد',[
            'fullName' => $request->fullName,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $request->password,
        ]);

    }
}
