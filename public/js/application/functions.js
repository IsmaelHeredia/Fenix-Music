/* Functions */

function convertMinutes(seconds) {
    var format = val => `0${Math.floor(val)}`.slice(-2)
    var hours = seconds / 3600
    var minutes = (seconds % 3600) / 60
  
    return [minutes, seconds % 60].map(format).join(':');
}

function lockControls() {
  $('#btnPlay').attr('disabled','disabled');
  $('#btnStop').attr('disabled','disabled');

  $('#btnSkipBack').attr('disabled','disabled');
  $('#btnSkipForward').attr('disabled','disabled');
  $('#btnFavorite').attr('disabled','disabled');

  $('#status-bar').attr('disabled','disabled');
  $('#volume-bar').attr('disabled','disabled');
}

function unlockControls() {
  $('#btnPlay').removeAttr('disabled');
  $('#btnStop').removeAttr('disabled');

  if(mostplayed_mode == false && news_mode == false) {
    $('#btnSkipBack').removeAttr('disabled');
    $('#btnSkipForward').removeAttr('disabled');
    $('#btnFavorite').removeAttr('disabled');
  }

  $('#status-bar').removeAttr('disabled');
  $('#volume-bar').removeAttr('disabled');
}

function unlockRadioControls() {
  $('#btnPlay').removeAttr('disabled');
  $('#btnStop').removeAttr('disabled');

  $('#btnSkipBack').removeAttr('disabled');
  $('#btnSkipForward').removeAttr('disabled');
  
  $('#volume-bar').removeAttr('disabled');
}

function getTableName() {
  var table_name = "";
  if(songs_mode == true) {
    table_name = "#table_songs";
  }
  else if(playlists_mode == true) {
    table_name = "#table_songs_playlist";
  }
  else if(favorites_mode == true) {
    table_name = "#table_favorites";
  }
  else if(stations_mode == true) {
    table_name = "#table_stations";
  }
  else if(mostplayed_mode == true) {
    table_name = "#table_mostplayed_songs";
  }
  else if(news_mode == true) {
    table_name = "#table_new_songs";
  }
  return table_name;
}

function getList() {
  var list = [];
  if(songs_mode == true) {
    list = songs;
  }
  else if(playlists_mode == true) {
    list = songs_playlist;
  }
  else if(favorites_mode == true) {
    list = favorites;
  }
  else if(stations_mode == true) {
    list = stations;
  }
  else if(mostplayed_mode == true) {
    list = mostplayed_songs;
  }
  else if(news_mode == true) {
    list = new_songs;
  }
  return list;
}

function deleteSong(song_id) {
  $.ajax({
    type: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "api/deleteSong",
    data: {"song_id" : song_id},
    dataType: 'json',
    async: false,
    success: function(result){
      var data = result;
      loadApp();
      toastr.success("Song deleted");
    },
    error: function(result) {
      console.log(result);
      toastr.error("Error deleting song");
    } 
  });
}

function deletePlaylist(playlist_id) {
  $.ajax({
    type: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "api/deletePlaylist",
    data: {"playlist_id" : playlist_id},
    dataType: 'json',
    async: false,
    success: function(result){
      var data = result;
      loadApp();
      toastr.success("Playlist deleted");
    },
    error: function(result) {
      console.log(result);
      toastr.error("Error deleting playlist");
    } 
  });
}

function deleteSongPlaylist(song_playlist_id,song_id) {
  $.ajax({
    type: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "api/deleteSongPlaylist",
    data: {"song_playlist_id" : song_playlist_id, "song_id" : song_id},
    dataType: 'json',
    async: false,
    success: function(result){
      var data = result;
      loadAppPlaylist();
      toastr.success("Song deleted");
    },
    error: function(result) {
      console.log(result);
      toastr.error("Error deleting song");
    } 
  });
}

function deleteStation(station_id) {
  $.ajax({
    type: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "api/deleteStation",
    data: {"station_id" : station_id},
    dataType: 'json',
    async: false,
    success: function(result){
      var data = result;
      loadApp();
      toastr.success("Station deleted");
    },
    error: function(result) {
      console.log(result);
      toastr.error("Error deleting station");
    } 
  });
}

function loadTabHome() {
  loadDataHome();
  loadTableMostPlayed();
  loadTableNews();
}

function loadTab(name) {
  if(name == "songs") {
    songs_tab = true;
  } else {
    songs_tab = false;
  }
  if(name == "playlists") {
    playlists_tab = true;
  } else {
    playlists_tab = false;
  }
  if(name == "favorites") {
    favorites_tab = true;
  } else {
    favorites_tab = false;
  }
  if(name == "stations") {
    stations_tab = true;
  } else {
    stations_tab = false;
  }
  $('#search').focus();
}

function search() {
  if(songs_tab == true) {
    loadTableSongs();
  }
  else if(playlists_tab == true) {
    if(playlist_id == "") {
      loadTablePlaylists();
    } else {
      loadTableSongsPlaylist(playlist_id);
    }
  }
  else if(favorites_tab == true) {
    loadTableFavorites();
  }
  else if(stations_tab == true) {
    loadStations();
  }
}