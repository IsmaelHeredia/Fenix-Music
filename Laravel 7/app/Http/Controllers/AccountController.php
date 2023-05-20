<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class AccountController extends Controller
{
    public function checkPassword(Request $request)
    {
        if (Auth::check()) {
            $password = $request->input('password');

            $userId = Auth::User()->id;
            $user = User::find($userId);
            $username = $user->username;

            if (Auth::attempt(['username' => $username, 'password' => $password])) {
                return response()->json([
                    'status' => 1
                ]);
            } else {
                return response()->json([
                    'status' => 0
                ]);
            }
        } else {
            return view('login.index');
        }
    }

    public function saveProfile(Request $request)
    {
        if (Auth::check()) {
            $username = $request->input('username');
            $email = $request->input('email');
            $new_password = $request->input('new-password');
            $password = $request->input('password');

            $userId = Auth::User()->id;
            $user = User::find($userId);
            $username_check = $user->username;

            if (Auth::attempt(['username' => $username_check, 'password' => $password])) {
                if($username != "") {
                    $user->username = $username;
                }
                if($email != "") {
                    $user->email = $email;
                }
                if($new_password != "") {
                    $user->password = Hash::make($new_password);
                }
                $user->save();
                Auth::logout();
                return redirect()->route('login')->with('message_ok','Profile updated');
            } else {
                return redirect()->route('home')->with('message_fail','Bad password');
            }
        } else {
            return view('login.index');
        }
    }
}