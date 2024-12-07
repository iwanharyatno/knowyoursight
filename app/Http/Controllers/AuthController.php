<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class AuthController extends BaseController
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('KnowYourSight_User')->plainTextToken;
        $success['user'] = $user;

        event(new Registered($user));

        return $this->sendResponse($success, 'User registered successfully');
    }

    public function login(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::find(Auth::user()->id);
            $success['token'] = $user->createToken('KnowYourSight_User')->plainTextToken;
            $success['user'] = $user;

            return $this->sendResponse($success, 'User login successfully');
        } else {
            return $this->sendError('User not found!');
        }
    }

    public function logout(Request $request) {
        $user = User::find(Auth::user()->id);

        if (!$user) {
            return $this->sendError('User not found (invalid)');
        }

        $user->tokens()->delete();

        return $this->sendResponse([], 'User logged out!');
    }

    public function me() {
        $user = User::find(Auth::user()->id);

        if (!$user) {
            return $this->sendError('User not found (invalid token)');
        }

        return $this->sendResponse($user, "User retrieved!");
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $user = User::find(Auth::user()->id);

        $data = $validator->validated();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();
        
        if (!$user) {
            return $this->sendError('Invalid token');
        }

        return $this->sendResponse($user, 'Modified successfully');
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $data = $validator->validated();

        $user = User::find(Auth::user()->id);

        if (!Hash::check($data['old_password'], $user->password)) {
            return $this->sendError('Old password doesn\'t match', [], 422);
        }
        
        $user->password = bcrypt($data['new_password']);
        $user->save();
        
        if (!$user) {
            return $this->sendError('Invalid token');
        }

        return $this->sendResponse($user, 'Password changed successfully');
    }
}