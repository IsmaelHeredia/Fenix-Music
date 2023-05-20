<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services;

class SettingsController extends Controller
{
    public function scanSongs(Request $request)
    {
        if (Auth::check()) {
            $services = new \App\Functions\Services();
            $directory = $request->input("directory");
            if($request->submit == "scan") {
                $count = $services->scanSongs($directory);
                return redirect()->route('home')->with('message_ok',$count . ' songs scanned');
            }
            else if($request->submit == "restart_database") {
                $services->restartDatabase();
                return redirect()->route('home')->with('message_ok','Database restarted');
            }
        } else {
            return view('login.index');
        }
    }
    
    public function importStations(Request $request)
    {
        if (Auth::check()) {
            $services = new \App\Functions\Services();
            if ($request->hasFile('json_file')) {
                $json_file = $request->json_file;
                $count = $services->importStations($json_file);
                return redirect()->route('home')->with('message_ok',$count . ' stations imported');
            }
        } else {
            return view('login.index');
        }
    }
}