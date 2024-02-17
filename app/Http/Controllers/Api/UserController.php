<?php

namespace App\Http\Controllers\Api;


use App\Models\User;
use Illuminate\Http\Request;


class UserController extends BaseController
{
    public function register(Request $request)
    {



        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);



        if ($validated) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->name);
            $user->save();
            $success['token'] = $user->createToken('restApi')->plainTextToken;
            $success['name'] = $user->name;

        } else {

            return $this->sendError('Validate Error', $validated);
        }

        return $this->sendResponse($success, 'User Registered');
    }
}
