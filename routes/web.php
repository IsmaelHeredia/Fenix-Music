<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(LoginController::class)->group(function(){
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');
    Route::get('logout', 'logout')->name('logout');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::post('/scan_songs', [SettingsController::class, 'scanSongs'])->name('scan_songs');
    Route::post('/import_stations', [SettingsController::class, 'importStations'])->name('import_stations');

    Route::get('/api/getData', [APIController::class, 'getData'])->name('getData');
    Route::get('/api/getDataHome', [APIController::class, 'getDataHome'])->name('getDataHome');
    Route::post('/api/loadSong', [APIController::class, 'loadSong'])->name('loadSong');
    Route::get('/api/unloadSong', [APIController::class, 'unloadSong'])->name('unloadSong');
    Route::post('/api/updateFavorite', [APIController::class, 'updateFavorite'])->name('updateFavorite');
    Route::post('/api/loadPlaylist', [APIController::class, 'loadPlaylist'])->name('loadPlaylist');
    Route::post('/api/deleteSong', [APIController::class, 'deleteSong'])->name('deleteSong');
    Route::post('/api/deletePlaylist', [APIController::class, 'deletePlaylist'])->name('deletePlaylist');
    Route::post('/api/deleteSongPlaylist', [APIController::class, 'deleteSongPlaylist'])->name('deleteSongPlaylist');
    Route::post('/api/deleteStation', [APIController::class, 'deleteStation'])->name('deleteStation');

    Route::post('/save_profile', [AccountController::class, 'saveProfile'])->name('save_profile');
    Route::post('/checkPassword', [AccountController::class, 'checkPassword'])->name('checkPassword');
});