/* Data */

function loadData() 
{
  var data;

  $.ajax({
    type: 'GET',
    url: "api/getData",
    dataType: 'json',
    async: false,
    success: function(result){
      data = result;
      console.log("DB Loaded");
    },
    error: function(result) {
      console.log(result);
    } 
  });

  mostplayed_songs = data.mostplayed_songs;
  new_songs = data.new_songs;
  songs = data.songs;
  playlists = data.playlists;
  favorites = data.favorites;
  stations = data.stations;
}

function loadDataHome() 
{
  var data;

  $.ajax({
    type: 'GET',
    url: "api/getDataHome",
    dataType: 'json',
    async: false,
    success: function(result){
      data = result;
      console.log("DB Home Loaded");
    },
    error: function(result) {
      console.log(result);
    } 
  });

  mostplayed_songs = data.mostplayed_songs;
  new_songs = data.new_songs;
}

/* Tables */

function loadTableSongs() 
{
  var text = $('#search').val();

  $("#table_songs > tbody").html("");

  var count = 0;

  $.each(songs, function(index, value) {
    var song_index = index;
    var id = value.id;
    var title = value.title;
    var artist = value.artist;
    var album = value.album;
    var year = value.year;
    var genre = value.genre;
    var time = value.time;
    var image = value.image;
    var favorite = value.favorite;
    var date = value.creation_date;

    if(title.toLowerCase().indexOf(text.toLowerCase()) !== -1) {
      $('#table_songs').append('<tr> \
              <td class="hide">' + song_index + '</td> \
              <td class="hide">' + id + '</td> \
              <td>' + title + '</td> \
              <td>' + artist + '</td> \
              <td>' + album + '</td> \
              <td>' + year + '</td> \
              <td>' + genre + '</td> \
              <td>' + time + '</td> \
              <td class="hide">' + image + '</td> \
              <td class="hide">' + favorite + '</td> \
              <td class="hide">' + date + '</td> \
              <td><button class="btn btn-dark" onclick="if (confirm(\'Are you sure you want to delete ?\')) { deleteSong(' + id + '); }"><i class="fa fa-times" aria-hidden="true"></i></button></td> \
      </tr>');
      count++;
    }
  });

  if(count == 0) {
    $("#table_songs").addClass("hide");
  } else {
    $("#table_songs").removeClass("hide");
  }

  $("#number_songs").text(count + " songs found");

  $(".scrollbar").scrollTop(0);
}

function loadTableFavorites() 
{
  var text = $('#search').val();

  $("#table_favorites > tbody").html("");

  var count = 0;

  $.each(favorites, function(index, value) {
    var song_index = index;
    var id = value.id;
    var title = value.title;
    var artist = value.artist;
    var album = value.album;
    var year = value.year;
    var genre = value.genre;
    var time = value.time;
    var image = value.image;
    var favorite = value.favorite;
    var date = value.creation_date;

    if(title.toLowerCase().indexOf(text.toLowerCase()) !== -1) {
      $('#table_favorites').append('<tr> \
              <td class="hide">' + song_index + '</td> \
              <td class="hide">' + id + '</td> \
              <td>' + title + '</td> \
              <td>' + artist + '</td> \
              <td>' + album + '</td> \
              <td>' + year + '</td> \
              <td>' + genre + '</td> \
              <td>' + time + '</td> \
              <td class="hide">' + image + '</td> \
              <td class="hide">' + favorite + '</td> \
              <td class="hide">' + date + '</td> \
      </tr>');
      count++;
    }
  });

  if(count == 0) {
    $("#table_favorites").addClass("hide");
  } else {
    $("#table_favorites").removeClass("hide");
  }  

  $("#number_favorites").text(count + " songs found");

  $(".scrollbar").scrollTop(0);
}

function loadTableMostPlayed() 
{
  $("#table_mostplayed_songs > tbody").html("");

  $.each(mostplayed_songs, function(index, value) {
    var song_index = index;
    var id = value.id;
    var title = value.title;
    var artist = value.artist;
    var album = value.album;
    var year = value.year;
    var genre = value.genre;
    var time = value.time;
    var image = value.image;
    var favorite = value.favorite;
    var date = value.creation_date;
    var amount_listened = value.amount_listened;

    $('#table_mostplayed_songs').append('<tr> \
            <td class="hide">' + song_index + '</td> \
            <td class="hide">' + id + '</td> \
            <td class="hide">' + title + '</td> \
            <td class="hide">' + artist + '</td> \
            <td class="hide">' + album + '</td> \
            <td class="hide">' + year + '</td> \
            <td class="hide">' + genre + '</td> \
            <td class="hide">' + time + '</td> \
            <td class="hide">' + image + '</td> \
            <td class="hide">' + favorite + '</td> \
            <td class="hide">' + date + '</td> \
            <td> \
            <div class="row"> \
            <div class="col-md-4 cover"> \
              <img class="img-responsive image" src="album_covers/' + image + '"/> \
            </div> \
            <div class="col-md-8 info"> \
              <div class="text-center"> \
                <div>' + title + '</div> \
                <div>' + artist + '</div> \
                <div id="amount">' + amount_listened + ' plays</div> \
              </div> \
            </div> \
          </div> \
            </td> \
    </tr>');
  });
  var count = mostplayed_songs.length;
  if(count == 0) {
    $("#number_most_played").text(count + " songs found");
  }
}

function loadTableNews() 
{
  $("#table_new_songs > tbody").html("");

  $.each(new_songs, function(index, value) {
    var song_index = index;
    var id = value.id;
    var title = value.title;
    var artist = value.artist;
    var album = value.album;
    var year = value.year;
    var genre = value.genre;
    var time = value.time;
    var image = value.image;
    var favorite = value.favorite;
    var date = value.creation_date;

    $('#table_new_songs').append('<tr> \
            <td class="hide">' + song_index + '</td> \
            <td class="hide">' + id + '</td> \
            <td class="hide">' + title + '</td> \
            <td class="hide">' + artist + '</td> \
            <td class="hide">' + album + '</td> \
            <td class="hide">' + year + '</td> \
            <td class="hide">' + genre + '</td> \
            <td class="hide">' + time + '</td> \
            <td class="hide">' + image + '</td> \
            <td class="hide">' + favorite + '</td> \
            <td class="hide">' + date + '</td> \
            <td> \
            <div class="row"> \
            <div class="col-md-4 cover"> \
              <img class="img-responsive image" src="album_covers/' + image + '"/> \
            </div> \
            <div class="col-md-8 info"> \
              <div class="text-center"> \
                <div>' + title + '</div> \
                <div>' + artist + '</div> \
                <div>' + date + '</div> \
              </div> \
            </div> \
          </div> \
            </td> \
    </tr>');
  });
  var count = new_songs.length;
  if(count == 0) {
    $("#number_new_songs").text(count + " songs found");
  }
}

function loadTablePlaylists() 
{
  var text = $('#search').val();

  $("#scrollbar_playlists").removeClass("hide");
  $("#table_playlists").removeClass("hide");

  $("#scrollbar_songs_playlist").addClass("hide");
  $("#table_songs_playlist").addClass("hide");

  $("#btnReturnPlaylists").addClass("hide");

  $("#table_playlists > tbody").html("");

  var count = 0;

  $.each(playlists, function(index, value) {
    var playlist_index = index;
    var id = value.id;
    var name = value.name;

    if(name.toLowerCase().indexOf(text.toLowerCase()) !== -1) {
      $('#table_playlists').append('<tr> \
              <td class="hide">' + playlist_index + '</td> \
              <td class="hide">' + id + '</td> \
              <td>' + name + '</td> \
              <td><button class="btn btn-dark" onclick="if (confirm(\'Are you sure you want to delete ?\')) { deletePlaylist(' + id + '); }"><i class="fa fa-times" aria-hidden="true"></i></button></td> \
      </tr>');
      count++;
    }
  });

  if(count == 0) {
    $("#table_playlists").addClass("hide");
  } else {
    $("#table_playlists").removeClass("hide");
  }    

  $("#number_playlists").text(count + " playlists found");

  $("#scrollbar_playlists").scrollTop(0);
}

function loadTableSongsPlaylist(playlist_id) 
{
  var text = $('#search').val();

  $("#scrollbar_playlists").addClass("hide");
  $("#table_playlists").addClass("hide");
  $("#btnReturnPlaylists").removeClass("hide");

  $("#table_songs_playlist > tbody").html("");

  var count = 0;

  $.ajax({
    type: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "api/loadPlaylist",
    data: {"playlist_id" : playlist_id},
    dataType: 'json',
    async: false,
    success: function(result){
      var data = result;
      songs_playlist = data.songs_playlist;
      $.each(songs_playlist, function(index, value) {
        var song_index = index;
        var id = value.id;
        var title = value.title;
        var artist = value.artist;
        var album = value.album;
        var year = value.year;
        var genre = value.genre;
        var time = value.time;
        var image = value.image;
        var favorite = value.favorite;
        var date = value.creation_date;
        var song_playlist_id = value.song_playlist_id;
    
        if(title.toLowerCase().indexOf(text.toLowerCase()) !== -1) {
          $('#table_songs_playlist').append('<tr> \
                  <td class="hide">' + song_index + '</td> \
                  <td class="hide">' + id + '</td> \
                  <td>' + title + '</td> \
                  <td>' + artist + '</td> \
                  <td>' + album + '</td> \
                  <td>' + year + '</td> \
                  <td>' + genre + '</td> \
                  <td>' + time + '</td> \
                  <td class="hide">' + image + '</td> \
                  <td class="hide">' + favorite + '</td> \
                  <td class="hide">' + date + '</td> \
                  <td><button class="btn btn-dark" onclick="if (confirm(\'Are you sure you want to delete ?\')) { deleteSongPlaylist(' + song_playlist_id + ',' + id + '); }"><i class="fa fa-times" aria-hidden="true"></i></button></td> \
          </tr>');
          count++;
        }
      });
    },
    error: function(result) {
      console.log(result);
    } 
  });

  if(count == 0) {
    $("#scrollbar_songs_playlist").addClass("hide");
    $("#table_songs_playlist").addClass("hide");
  } else {
    $("#scrollbar_songs_playlist").removeClass("hide");
    $("#table_songs_playlist").removeClass("hide");
  }   

  $("#number_playlists").text(count + " songs found");

  $("#scrollbar_songs_playlist").scrollTop(0);
}

function loadStations() 
{
  var text = $('#search').val();
  
  $("#table_stations > tbody").html("");

  var count = 0;

  $.each(stations, function(index, value) {
    var station_index = index;
    var id = value.id;
    var name = value.name;
    var link = value.link;
    var categories = value.categories;

    if(name.toLowerCase().indexOf(text.toLowerCase()) !== -1) {
      $('#table_stations').append('<tr> \
              <td class="hide">' + station_index + '</td> \
              <td class="hide">' + id + '</td> \
              <td>' + name + '</td> \
              <td>' + link + '</td> \
              <td>' + categories + '</td> \
              <td><button class="btn btn-dark" onclick="if (confirm(\'Are you sure you want to delete ?\')) { deleteStation(' + id + '); }"><i class="fa fa-times" aria-hidden="true"></i></button></td> \
      </tr>');
      count++;
    }
  });

  if(count == 0) {
    $("#table_stations").addClass("hide");
  } else {
    $("#table_stations").removeClass("hide");
  }     

  $("#number_stations").text(count + " stations found");

  $(".scrollbar").scrollTop(0);
}

// App functions

function loadApp() {
  loadData();
  loadTableSongs();
  loadTableFavorites();
  loadTableMostPlayed();
  loadTableNews();
  loadTablePlaylists();
  loadStations();
}

function loadAppPlaylist() {
  loadData();
  loadTableSongs();
  loadTableFavorites();
  loadTableMostPlayed();
  loadTableNews();
  loadTableSongsPlaylist(playlist_id);
  loadStations();
}

function loadAppFavorites() {
  loadData();
  loadTableFavorites();
}

// Call app

loadApp();
