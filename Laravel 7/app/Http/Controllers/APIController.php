<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;
use App\Song;
use App\Playlist;
use App\SongPlaylist;
use App\Station;

class APIController extends Controller
{
    public function getData()
    {
        if (Auth::check()) {
            $songs = Song::orderBy('creation_date','DESC')->get();
            $list_mostplayed = Song::orderBy('amount_listened','DESC')->get()->toArray();
            $mostplayed_songs = array_slice($list_mostplayed, 0, 5, true);
            $new_songs = array_slice($songs->toArray(), 0, 5, true);
            $favorites = array();
            foreach($songs as $song) {
                if($song->favorite == 1) {
                    array_push($favorites, $song);
                }
            }
            $playlists = Playlist::orderBy('name','ASC')->get();
            $stations = Station::orderBy('name','ASC')->get();
            return Response::json(array('mostplayed_songs'=>$mostplayed_songs,'new_songs'=>$new_songs,'songs'=>$songs,'playlists'=>$playlists,'favorites'=>$favorites,'stations'=>$stations));
        } else {
            return view('login.index');
        }
    }

    public function getDataHome()
    {
        if (Auth::check()) {
            $songs = Song::orderBy('creation_date','DESC')->get();
            $list_mostplayed = Song::orderBy('amount_listened','DESC')->get()->toArray();
            $mostplayed_songs = array_slice($list_mostplayed, 0, 5, true);
            $new_songs = array_slice($songs->toArray(), 0, 5, true);
            return Response::json(array('mostplayed_songs'=>$mostplayed_songs,'new_songs'=>$new_songs));
        } else {
            return view('login.index');
        }
    }

    public function loadSong(Request $request)
    {
        if (Auth::check()) {
            $id = $request->input('id');
            $song = Song::find($id);
            $path = $song->path;
            $count = $song->amount_listened + 1;
            $song->amount_listened = $count;
            $song->save();
            $name = basename($path,'.mp3');
            $code = rand(100,1000);
            $fullname = $name . '_' . $code . '.mp3';
            $mp3_dir = public_path('mp3_files') . '/' . $fullname;
            if(file_exists($mp3_dir)) {
                unlink($mp3_dir);
            }
            copy($path, $mp3_dir);
            return response()->json([
                'status' => 1,
                'mp3_file' => $fullname
            ]);
        } else {
            return view('login.index');
        }
    }

    public function unloadSong()
    {
        if (Auth::check()) {
            $directory = public_path('mp3_files');
            $files = glob($directory . '/*');
            foreach($files as $file){
              if(is_file($file))
                unlink($file);
            }
            return response()->json([
                'status' => 1
            ]);
        } else {
            return view('login.index');
        }
    }

    public function updateFavorite(Request $request) {
        if (Auth::check()) {
            $id = $request->input('id');
            $favorite = $request->input('favorite');
            $song = Song::find($id);
            $song->favorite = $favorite;
            $song->save();
            return response()->json([
                'status' => 1
            ]);
        } else {
            return view('login.index');
        }
    }

    public function loadPlaylist(Request $request)
    {
        if (Auth::check()) {
            $playlist_id = $request->input('playlist_id');
            $songs_playlist = DB::select('SELECT s.id,s.title,s.artist,s.album,s.year,s.genre,s.time,s.image,s.favorite,s.amount_listened,s.path,s.creation_date,sp.id AS song_playlist_id FROM songs s,songs_playlist sp WHERE s.id = sp.song_id AND sp.playlist_id = :playlist_id ORDER BY s.creation_date DESC', ['playlist_id' => $playlist_id]);
            return Response::json(array('songs_playlist'=>$songs_playlist));
        } else {
            return view('login.index');
        }
    }

    public function deleteSong(Request $request) {
        if (Auth::check()) {
            $song_id = $request->input('song_id');
            SongPlaylist::where('song_id',$song_id)->delete();
            $song = Song::find($song_id);
            $path = $song->path;
            $image = $song->image;
            $cover = public_path('album_covers') . "\\" . $image;

            if(file_exists($cover) && $image != "fenix.jpg") {
                unlink($cover);
            }
            if(file_exists($path)) {
                unlink($path);
            }
            
            $song->delete();
            return response()->json([
                'status' => 1
            ]);
        } else {
            return view('login.index');
        }
    }

    public function deletePlaylist(Request $request) {
        if (Auth::check()) {
            $playlist_id = $request->input('playlist_id');
            $playlist = Playlist::find($playlist_id);

            $songs_playlist = SongPlaylist::where('playlist_id',$playlist_id)->get();
            $dir_playlist = "";
            foreach($songs_playlist as $song_playlist) {
                $song = Song::find($song_playlist->song_id);
                $path = $song->path;
                $image = $song->image;
                $cover = public_path('album_covers') . "\\" . $image;
                $dir_playlist = dirname($path);

                if(file_exists($cover) && $image != "fenix.jpg") {
                    unlink($cover);
                }
                if(file_exists($path)) {
                    unlink($path);
                }

                $song_playlist->delete();
                $song->delete();
            }
            
            $playlist->delete();

            if(count(glob("$dir_playlist/*")) === 0) {
                rmdir($dir_playlist);
            }

            return response()->json([
                'status' => $dir_playlist
            ]);
        } else {
            return view('login.index');
        }
    }

    public function deleteSongPlaylist(Request $request) {
        if (Auth::check()) {
            $song_playlist_id = $request->input('song_playlist_id');
            $song_id = $request->input('song_id');

            $song_playlist = SongPlaylist::find($song_playlist_id);
            $song = Song::find($song_id);

            $path = $song->path;
            $image = $song->image;
            $cover = public_path('album_covers') . "\\" . $image;

            if(file_exists($cover) && $image != "fenix.jpg") {
                unlink($cover);
            }
            if(file_exists($path)) {
                unlink($path);
            }

            $song_playlist->delete();
            $song->delete();

            return response()->json([
                'status' => 1
            ]);
        } else {
            return view('login.index');
        }
    }

    public function deleteStation(Request $request) {
        if (Auth::check()) {
            $station_id = $request->input('station_id');
            $station = Station::find($station_id);
            $station->delete();
            return response()->json([
                'status' => 1
            ]);
        } else {
            return view('login.index');
        }
    }
}