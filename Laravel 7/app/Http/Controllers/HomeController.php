<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $drive = getenv("SystemDrive");
            $username = getenv("username");
            $music_directory = $drive . "\\Users\\" . $username . "\\Music";
            $user = Auth::User()->username;
            $email = Auth::User()->email;
            return view('home.index')->with('music_directory', $music_directory)->with('username', $user)->with('email', $email);
        } else {
            return view('login.index');
        }
    }
}