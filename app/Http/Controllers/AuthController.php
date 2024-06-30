<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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
            $request->session()->regenerate();
            $user = Auth::user();
            // $request->session();
            return response()->json(['message' => 'Login successful', 'user' => $user]);
        } else {
            // Authentication failed
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'unique:users,email'],
            'name' => ['required'],
            'password' => ['required'],
        ], [
            'name.required' => 'Vui lòng nhập tên người dùng.',
            'email.required' => 'Vui lòng nhập email người dùng.',
            'email.unique' => 'Email phải là duy nhất.',
            'password.required' => 'Vui lòng nhập mật khẩu người dùng.',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
        $user_info = array_merge($validator->validated(), [
            'password' => bcrypt($validator->validated()['password'])  // Hash the password before storing it in the database.
        ]);
        $new_user =  User::create($user_info);
        return response()->json(['data' => $new_user], 201);
    }
    public function logout(Request $request)
    {

        Auth::logoutOtherDevices(12345678);

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
    public function confirmPassword(Request $request)
    {
        $currentTimeout = config('auth.password_timeout');
        $newTimeout = 3600;
        Config::set('auth.password_timeout', $newTimeout);
        $updatedTimeout = config('auth.password_timeout');
        $request->session()->passwordConfirmed();
        return response()->json([
            'message' => 'Confirm password successful',
            'current_timeout' => $currentTimeout,
            'updated_timeout' => $updatedTimeout,
        ], 200);
    }
}
