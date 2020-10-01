<?php

use Illuminate\Support\Facades\Route;

Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/scan_songs', 'SettingsController@scanSongs')->name('scan_songs');
    Route::post('/import_stations', 'SettingsController@importStations')->name('import_stations');
    Route::get('/api/getData', 'APIController@getData')->name('getData');
    Route::get('/api/getDataHome', 'APIController@getDataHome')->name('getDataHome');
    Route::post('/api/loadSong', 'APIController@loadSong')->name('loadSong');
    Route::get('/api/unloadSong', 'APIController@unloadSong')->name('unloadSong');
    Route::post('/api/updateFavorite', 'APIController@updateFavorite')->name('updateFavorite');
    Route::post('/api/loadPlaylist', 'APIController@loadPlaylist')->name('loadPlaylist');
    Route::post('/api/deleteSong', 'APIController@deleteSong')->name('deleteSong');
    Route::post('/api/deletePlaylist', 'APIController@deletePlaylist')->name('deletePlaylist');
    Route::post('/api/deleteSongPlaylist', 'APIController@deleteSongPlaylist')->name('deletePlaylistSong');
    Route::post('/api/deleteStation', 'APIController@deleteStation')->name('deleteStation');
    Route::post('/save_profile', 'AccountController@saveProfile')->name('save_profile');
    Route::post('/checkPassword', 'AccountController@checkPassword')->name('check_password');
});