@extends('layouts.layout_admin')
@section('content')

<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active show" id="home">
        <div class="row">
            <div class="col-lg-6">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Most Played</h1>
                </div>
                <span id="number_most_played" class="numbers"></span>
                <div class="scrollbar-no-horizontal">
                    <table class="table table-hover" id="table_mostplayed_songs">
                    <tbody>
                    </tbody>                
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">New songs</h1>
                </div>    
                <span id="number_new_songs" class="numbers"></span>        
                <div class="scrollbar-no-horizontal">
                    <table class="table table-hover" id="table_new_songs">
                    <tbody>
                    </tbody>                
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="songs">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 class="h2">Songs</h1>
        </div>
        <span id="number_songs" class="numbers"></span>
        <br/>
        <br/>
        <div class="scrollbar">
            <table class="table table-hover" id="table_songs">
                <thead>
                    <tr>
                        <th scope="col" class="hide">#</th>
                        <th scope="col" class="hide">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Album</th>
                        <th scope="col">Year</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Time</th>
                        <th scope="col" class="hide">Image</th>
                        <th scope="col" class="hide">Favorite</th>
                        <th scope="col" class="hide">Date</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade" id="playlists">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 id="playlist_name" class="h2">Playlists</h1>
        </div>
        <span id="number_playlists" class="numbers"></span>
        <br/>
        <br/>
        <button type="button" class="btn btn-dark hide" id="btnReturnPlaylists"><i class="fa fa-reply" aria-hidden="true"></i></button>
        <div id="scrollbar_playlists" class="scrollbar">
            <table class="table table-hover" id="table_playlists">
                <thead>
                    <tr>
                    <th scope="col" class="hide">#</th>
                    <th scope="col" class="hide">ID</th>
                    <th scope="col">Name</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div id="scrollbar_songs_playlist" class="scrollbar-playlist hide">
            <table class="table table-hover hide" id="table_songs_playlist">
                <thead>
                    <tr>
                        <th scope="col" class="hide">#</th>
                        <th scope="col" class="hide">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Album</th>
                        <th scope="col">Year</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Time</th>
                        <th scope="col" class="hide">Image</th>
                        <th scope="col" class="hide">Favorite</th>
                        <th scope="col" class="hide">Date</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade" id="favorites">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 class="h2">Favorites</h1>
        </div>
        <span id="number_favorites" class="numbers"></span>
        <br/>
        <br/>
        <div class="scrollbar">
            <table class="table table-hover" id="table_favorites">
                <thead>
                    <tr>
                        <th scope="col" class="hide">#</th>
                        <th scope="col" class="hide">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Album</th>
                        <th scope="col">Year</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Time</th>
                        <th scope="col" class="hide">Image</th>
                        <th scope="col" class="hide">Favorite</th>
                        <th scope="col" class="hide">Date</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>                
            </table>
        </div>
    </div>
    <div class="tab-pane fade" id="stations">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 class="h2">Stations</h1>
        </div>
        <span id="number_stations" class="numbers"></span>
        <br/>
        <br/>
        <div class="scrollbar">
            <table class="table table-hover" id="table_stations">
            <thead>
                <tr>
                <th scope="col" class="hide">#</th>
                <th scope="col" class="hide">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Link</th>
                <th scope="col">Categories</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade" id="settings">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Settings</h1>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header bg-primary">Scan songs</div>
                    <div class="card-body">
                        <div class="card-block">
                        <form action="{{ route('scan_songs') }}" method="POST">
                                @csrf
                                <legend>Data</legend>
                                <div class="form-group">
                                    <label>Directory</label>
                                    <input type="text" id="directory" name="directory" class="form-control" value="{{$music_directory}}" placeholder="Enter directory" required/>
                                </div>                                
                                <div class="text-center">
                                    <p class="lead">
                                        <button type="submit" class="btn btn-primary long-button" name="submit" value="scan"><i class="fa fa-search icon" aria-hidden="true"></i>Scan</button>
                                        <button type="submit" class="btn btn-primary long-button" name="submit" value="restart_database"><i class="fa fa-undo icon" aria-hidden="true"></i>Restart database</button>
                                    </p>
                                </div>               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header bg-primary">Import stations</div>
                    <div class="card-body">
                        <div class="card-block">
                            <form action="{{ route('import_stations') }}" method="POST" enctype="multipart/form-data">
                                @csrf        
                                <legend>Data</legend>
                                <div class="form-group">
                                    <label>Select JSON File</label>
                                    <input type="file" id="json_file" name="json_file" class="form-control" required/>
                                </div>
                                <br/>
                                <div class="text-center">
                                    <p class="lead">
                                        <button type="submit" class="btn btn-primary long-button"><i class="fa fa-database icon" aria-hidden="true"></i>Import</button>
                                    </p>
                                </div>               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="profile">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Profile</h1>
        </div>
        <form name="form_profile" action="{{ route('save_profile') }}" method="POST">
            @csrf        
            <legend>Data</legend>
            <div class="form-group">
                <label>Username</label>
                <input type="text" id="username" name="username" class="form-control w-25" value="{{$username}}" placeholder="Enter username"required/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" id="email" name="email" class="form-control w-25" value="{{$email}}" placeholder="Enter email" required/>
            </div>
            <div class="form-group">
                <label>New password</label>
                <input type="password" id="new-password" name="new-password" class="form-control w-25" placeholder="Enter new password"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password" class="form-control w-25" placeholder="Enter password" required/>
            </div>
            <br/>
            <button type="submit" class="btn btn-primary medium-button"><i class="fa fa-floppy-o icon" aria-hidden="true"></i>Save</button>
        </form>
    </div>
    <div class="tab-pane fade" id="about">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">About</h1>
        </div>
        <h5>Program : Fenix Music</h5>
        <div class="tiny-space"></div>
        <h5>Version : 1.0</h5>
        <div class="tiny-space"></div>
        <h5>Description : MP3 Player and streaming radio</h5>
        <div class="tiny-space"></div>
        <h5>Author : Ismael Heredia</h5>
    </div>
</div>

@endsection