<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['data' => $user], 200);
    }
}
