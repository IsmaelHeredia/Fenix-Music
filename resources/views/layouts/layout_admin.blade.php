<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport"
	content="width=device-width, initial-scale=1, user-scalable=yes">
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ $titulo ?? 'Fenix Music' }}</title>
  <link rel="icon" href="{{ asset('images/fenix.jpg') }}">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/toastr.min.js') }}"></script>
  <script src="{{ asset('js/jquery.marquee.min.js') }}"></script>
  <style>
  </style>
</head>
<body>
	  <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow gray">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0 black" href="#">Fenix Music 1.0</a>
      <input id="search" class="form-control w-100 white" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link"><i class="fa fa-user-circle icon" aria-hidden="true"></i> {{ Auth::user()->username }}</a>
        </li>
      </ul>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="{{ url('logout') }}"><i class="fa fa-sign-out icon" aria-hidden="true"></i> Logout</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar black">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home" onclick="loadTabHome()">
                  <i class="fa fa-home icon" aria-hidden="true"></i>Home <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#songs" onclick="loadTab('songs')">
                  <i class="fa fa-music icon" aria-hidden="true"></i>Songs
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#playlists" onclick="loadTab('playlists')">
                  <i class="fa fa-list icon" aria-hidden="true"></i>Playlists
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#favorites" onclick="loadTab('favorites')">
                  <i class="fa fa-heart icon" aria-hidden="true"></i>Favorites
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#stations" onclick="loadTab('stations')">
                  <i class="fa fa-rss icon" aria-hidden="true"></i>Stations
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings">
                  <i class="fa fa-cog icon" aria-hidden="true"></i>Settings
                </a>
              </li>  
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#profile">
                  <i class="fa fa-user-circle icon" aria-hidden="true"></i>Profile
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#about">
                  <i class="fa fa-info-circle icon" aria-hidden="true"></i>About
                </a>
              </li>           
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            @if(Session::has('message_fail'))
            <div class="alert alert-danger alert-dismissible message">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message_fail') }}
            </div>
            @endif
            @if(Session::has('message_ok'))
            <div class="alert alert-success alert-dismissible message">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message_ok') }}
            </div>
            @endif
          @yield('content')
        </main>
        
      </div>
    </div>

    <footer class="fixed-bottom">
      <div class="row">
        <div class="col-md-4">
          <div class="row">
            <div class="col-md-4 cover">
              <img id="image" class="img-responsive image"/>
            </div>
            <div class="col-md-8 info">
              <div class="text-center">
                <div id="title" class="marquee"></div>
                <br/>
                <div id="artist"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 player">
          <div class="row">
            <div class="col-md-1 time"><div id="status">0:00</div></div>
            <div class="col-md-9">
              <input type="range" min="0" max="" value="0" id="status-bar">
            </div>
            <div class="col-md-1 time"><div id="duration">0:00</div></div>
          </div>
          <div class="btn-group d-flex">
            <button type="button" class="btn btn-dark" id="btnFavorite" data-toggle="tooltip" data-placement="top" title="Favorite"><i id="iconFavorite" class="fa fa-heart fa-2x" aria-hidden="true"></i></button>
            <button type="button" class="btn btn-dark" id="btnSkipBack" data-toggle="tooltip" data-placement="top" title="Skip back"><i class="fa fa-backward fa-2x"></i></button>
            <button type="button" class="btn btn-dark" style="display: none;" id="btnPause" data-toggle="tooltip" data-placement="top" title="Pause"><i class="fa fa-pause-circle fa-2x"></i></button>
            <button type="button" class="btn btn-dark" id="btnPlay" data-toggle="tooltip" data-placement="top" title="Play"><i class="fa fa-play-circle fa-2x"></i></button>
            <button type="button" class="btn btn-dark" id="btnStop" data-toggle="tooltip" data-placement="top" title="Stop"><i class="fa fa-stop-circle fa-2x"></i></button>
            <button type="button" class="btn btn-dark" id="btnSkipForward" data-toggle="tooltip" data-placement="top" title="Skip forward"><i class="fa fa-forward fa-2x"></i></button>
            <button type="button" class="btn btn-dark" id="btnRepeat" data-toggle="tooltip" data-placement="top" title="Repeat"><i id="iconRepeat" class="fa fa-refresh fa-2x"></i></button>
          </div>          
        </div>
        <div class="col-md-2">
          <div class="text-center">
          <div class="volume">
            <i class="fa fa-volume-up fa-2x"></i>
            <input id="volume-bar" type="range" min="0" max="1" value="1" step="0.01" onchange="changeVolume(this.value)" oninput="changeVolume(this.value)"/>
          </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="{{ asset('js/application/vars.js') }}"></script>
    <script src="{{ asset('js/application/controls.js') }}"></script>
    <script src="{{ asset('js/application/player.js') }}"></script>
    <script src="{{ asset('js/application/radio.js') }}"></script>
    <script src="{{ asset('js/application/data.js') }}"></script>
    <script src="{{ asset('js/application/functions.js') }}"></script>
    <script src="{{ asset('js/application/others.js') }}"></script>

    <script src="{{ asset('js/howler.core.min.js') }}"></script>
</body>
</html>