<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'password' => ['required'],
        ], [
            'name.required' => 'Vui lòng nhập tên người dùng.',
            'password.required' => 'Vui lòng nhập mật khẩu người dùng.',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
        $credential = $validator->validated();

        if (Auth::attempt($credential)) {
            $user = Auth::user();
            return response()->json(['message' => 'Login successful', 'user' => $user]);
        } else {
            // Authentication failed
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'password' => ['required'],
        ], [
            'name.required' => 'Vui lòng nhập tên người dùng.',
            'password.required' => 'Vui lòng nhập mật khẩu người dùng.',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
        $user_info = $validator->validated();
        dd($user_info);
    }
    public function logout()
    {
        dd(1);
    }
}
