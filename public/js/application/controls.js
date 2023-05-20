/* Controls */

$(document).ready(function() {

    $('tr').bind('selectstart', function(event) {
      event.preventDefault();
    });

    $("#table_mostplayed_songs").on("dblclick", "tr", function() {
      stop();
      song_index = $(this).closest('tr').find('td:nth-child(1)').text();
      song_id = $(this).closest('tr').find('td:nth-child(2)').text();
      title = $(this).closest('tr').find('td:nth-child(3)').text();
      artist = $(this).closest('tr').find('td:nth-child(4)').text();
      album = $(this).closest('tr').find('td:nth-child(5)').text();
      year = $(this).closest('tr').find('td:nth-child(6)').text();
      genre = $(this).closest('tr').find('td:nth-child(7)').text();
      time = $(this).closest('tr').find('td:nth-child(8)').text();
      image = $(this).closest('tr').find('td:nth-child(9)').text();
      favorite = $(this).closest('tr').find('td:nth-child(10)').text();

      if(song_id != "") {
        var amount = parseInt($(this).closest('tr').find('div #amount').text());
        var amount_listened = amount + 1;
        $(this).closest('tr').find('div #amount').text(amount_listened + ' plays');
        
        songs_mode = false;
        playlists_mode = false;
        favorites_mode = false;
        stations_mode = false;
        mostplayed_mode = true;
        news_mode = false;   
        play();
      }
    });
    
    $("#table_new_songs").on("dblclick", "tr", function() {
      stop();
      song_index = $(this).closest('tr').find('td:nth-child(1)').text();
      song_id = $(this).closest('tr').find('td:nth-child(2)').text();
      title = $(this).closest('tr').find('td:nth-child(3)').text();
      artist = $(this).closest('tr').find('td:nth-child(4)').text();
      album = $(this).closest('tr').find('td:nth-child(5)').text();
      year = $(this).closest('tr').find('td:nth-child(6)').text();
      genre = $(this).closest('tr').find('td:nth-child(7)').text();
      time = $(this).closest('tr').find('td:nth-child(8)').text();
      image = $(this).closest('tr').find('td:nth-child(9)').text();
      favorite = $(this).closest('tr').find('td:nth-child(10)').text();
      if(song_id != "") {
        songs_mode = false;
        playlists_mode = false;
        favorites_mode = false;
        stations_mode = false;
        mostplayed_mode = false;
        news_mode = true;   
        play();
      }
    });

    $("#table_songs").on("dblclick", "tr", function() {
        stop();
        song_index = $(this).closest('tr').find('td:nth-child(1)').text();
        song_id = $(this).closest('tr').find('td:nth-child(2)').text();
        title = $(this).closest('tr').find('td:nth-child(3)').text();
        artist = $(this).closest('tr').find('td:nth-child(4)').text();
        album = $(this).closest('tr').find('td:nth-child(5)').text();
        year = $(this).closest('tr').find('td:nth-child(6)').text();
        genre = $(this).closest('tr').find('td:nth-child(7)').text();
        time = $(this).closest('tr').find('td:nth-child(8)').text();
        image = $(this).closest('tr').find('td:nth-child(9)').text();
        favorite = $(this).closest('tr').find('td:nth-child(10)').text();
        if(song_id != "") {
          songs_mode = true;
          playlists_mode = false;
          favorites_mode = false;
          stations_mode = false;
          mostplayed_mode = false;
          news_mode = false;   
          play();
        }
    });
  
    $("#table_favorites").on("dblclick", "tr", function() {
      stop();
      song_index = $(this).closest('tr').find('td:nth-child(1)').text();
      song_id = $(this).closest('tr').find('td:nth-child(2)').text();
      title = $(this).closest('tr').find('td:nth-child(3)').text();
      artist = $(this).closest('tr').find('td:nth-child(4)').text();
      album = $(this).closest('tr').find('td:nth-child(5)').text();
      year = $(this).closest('tr').find('td:nth-child(6)').text();
      genre = $(this).closest('tr').find('td:nth-child(7)').text();
      time = $(this).closest('tr').find('td:nth-child(8)').text();
      image = $(this).closest('tr').find('td:nth-child(9)').text();
      favorite = $(this).closest('tr').find('td:nth-child(10)').text();
      if(song_id != "") {
        songs_mode = false;
        playlists_mode = false;
        favorites_mode = true;
        stations_mode = false;
        mostplayed_mode = false;
        news_mode = false;   
        play();
      }
    });

    $("#table_playlists").on("dblclick", "tr", function() {
      stop();
      playlist_index = $(this).closest('tr').find('td:nth-child(1)').text();
      playlist_id = $(this).closest('tr').find('td:nth-child(2)').text();
      playlist_name = $(this).closest('tr').find('td:nth-child(3)').text();
      $('#playlist_name').text(playlist_name + " - Playlist");
      loadTableSongsPlaylist(playlist_id);
    });

    $("#table_songs_playlist").on("dblclick", "tr", function() {
      stop();
      song_index = $(this).closest('tr').find('td:nth-child(1)').text();
      song_id = $(this).closest('tr').find('td:nth-child(2)').text();
      title = $(this).closest('tr').find('td:nth-child(3)').text();
      artist = $(this).closest('tr').find('td:nth-child(4)').text();
      album = $(this).closest('tr').find('td:nth-child(5)').text();
      year = $(this).closest('tr').find('td:nth-child(6)').text();
      genre = $(this).closest('tr').find('td:nth-child(7)').text();
      time = $(this).closest('tr').find('td:nth-child(8)').text();
      image = $(this).closest('tr').find('td:nth-child(9)').text();
      favorite = $(this).closest('tr').find('td:nth-child(10)').text();
      if(song_id != "") {
        songs_mode = false;
        playlists_mode = true;
        favorites_mode = false;
        stations_mode = false;
        mostplayed_mode = false;
        news_mode = false;   
        play();
      }
    });  

    $("#table_stations").on("dblclick", "tr", function() {
      stop();
      stop_station();
      station_index = $(this).closest('tr').find('td:nth-child(1)').text();
      station_id = $(this).closest('tr').find('td:nth-child(2)').text();
      name = $(this).closest('tr').find('td:nth-child(3)').text();
      link = $(this).closest('tr').find('td:nth-child(4)').text();
      categories = $(this).closest('tr').find('td:nth-child(5)').text();
      if(station_id != "") {
        songs_mode = false;
        playlists_mode = false;
        favorites_mode = false;
        stations_mode = true;
        mostplayed_mode = false;
        news_mode = false;   
        play_station();
      }
    });  

    $('#btnPlay').on("click", function() {
      play();
    });
  
    $('#btnPause').on("click", function() {
      pause();
    });
  
    $('#btnStop').on("click", function() {
      if(stations_mode == true) {
        stop_station();
      } else {
        stop();
      }
    });
  
    $('#btnSkipBack').on("click", function() {
      if(stations_mode == true) {
        skip_back_station();
      } else {
        if(player != null) {
          skip_back();
        }
      }
    });
  
    $('#btnSkipForward').on("click", function() {
      if(stations_mode == true) {
        skip_forward_station();
      } else {
        if(player != null) {
          skip_forward();
        }
      }
    });  
  
    $('#btnFavorite').on("click", function() {
      if(player != null) {
        if(favorite == 0) {
          favorite = 1;
          $('#iconFavorite').attr('class', 'fa fa-heart-o fa-2x');
        } else {
          favorite = 0;
          $('#iconFavorite').attr('class', 'fa fa-heart fa-2x');
        }
  
        var table_name = getTableName();
        var rows = $(table_name).find('tbody').find('tr');
        for (var i = 0; i < rows.length; i++) {
          var row = $(rows[i]);
          var id = row.find('td:eq(1)').html();
          if(id == song_id) {
            row.find('td:eq(9)').text(favorite);
          }
        }
  
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "api/updateFavorite",
            data: {"id" : song_id, "favorite" : favorite},
            dataType: 'json',
            async: false,
            success: function(result){
              var data = result;
            },
            error: function(result) {
              console.log(result);
            } 
        });

        loadAppFavorites();
  
      }
    });
  
    $('#btnRepeat').on("click", function() {
      if(repeat_mode == false) {
        repeat_mode = true;
        $('#iconRepeat').attr('class', 'fa fa-history fa-2x');
      } else {
        repeat_mode = false;
        $('#iconRepeat').attr('class', 'fa fa-refresh fa-2x');
      }
    });

    $('#btnReturnPlaylists').on("click", function() {
      stop();
      playlist_index = "";
      playlist_id = "";
      playlist_name = "";
      $('#playlist_name').text("Playlists");
      loadTablePlaylists();
    });
  
  });