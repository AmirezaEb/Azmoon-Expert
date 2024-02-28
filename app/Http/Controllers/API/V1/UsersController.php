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

    public function updateInfo(Request $request)
    {
        $this->validate($request,[
            'id' => 'required|string',
            'fullName' => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string',
        ]);

        $this->userRepository->update($request->id,[
            'fullName' => $request->fullName,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);

        return $this->responseSuccess('کابر با موفقیت بروز رسانی شد', [
            'fullName' => $request->fullName,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'password' => 'min:6|required_with:password_repeat|same:password_repeat',
            'password_repeat' =>'min:6'
        ]);

        $this->userRepository->update($request->id,[
            'password' => app('hash')->make($request->password),
        ]);

        return $this->responseSuccess('رمز عبور شما با موفقیت بروز رسانی شد',[
            'fullName' => $request->fullName,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);
    }
}
