/* Player */

function play() {

  if(pause_mode == true && skip_mode == false) {
    if(player != null) {
      player.play();
      pause_mode = false;
    }
  } 
  else 
  {
    stop_station();
    stop();

    var data;

    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "api/loadSong",
        data: {"id" : song_id},
        dataType: 'json',
        async: false,
        success: function(result){
          data = result;
        },
        error: function(result) {
          console.log(result);
        } 
    });

    var mp3_file = data.mp3_file;

    if(song_id == "") {
      toastr.warning("Select song");
    } else {

      player = new Howl({
        src: ["mp3_files/" + mp3_file],
        html5: true,
        format: ["mp3", "aac"],
        onplay: function() {
          id = requestAnimationFrame(step);

          var table_name = getTableName();
          var rows = $(table_name).find('tbody').find('tr');
          for (var i = 0; i < rows.length; i++) {
            var row = $(rows[i]);
            var id = row.find('td:eq(1)').html();
            if(id == song_id) {
              row.addClass("itemSelected");
            }
          }
          
          btnPlay.style.display = "none";
          btnPause.style.display = "block";
      
          $('#duration').text(convertMinutes(player.duration()));
          $('#status-bar').attr('max', player.duration());
          $('#artist').text(artist);
          $('#image').attr("src","album_covers/" + image);

          if(status_seek == false) {
            $('#title').text(title);
            $('#title').marquee({duration: 8000});
          }

          if(favorite == 0) {
            $('#iconFavorite').attr('class', 'fa fa-heart fa-2x');
          } else {
            $('#iconFavorite').attr('class', 'fa fa-heart-o fa-2x');
          }

          unlockControls();

        },
        onend: function() {
          if(mostplayed_mode == true || news_mode == true) {
            stop();
          } else {
            if(repeat_mode == true) {
              play();
            } else {
              skip_forward();
            }
          }
        },
        onloaderror: function(error) {
          toastr.error("Playback error occurred");
        }
      });

      player.play();
    }
  }
}

var rangeInput = $('#status-bar');

rangeInput.change(seek);
rangeInput.on("mouseenter", () => {
  mousehover = true;
  status_seek = true;
})
rangeInput.on("mouseout", () => {
  mousehover = false;
  status_seek = true;
  step();
})

function step() {
  var seek = 0;
  if(player != null) {
    seek = player.seek();
  }
  rangeInput.val(seek);
  if(player != null) {
    if (!mousehover && player.playing()) {
      id = requestAnimationFrame(step);
    }
  }
  $('#status').html(convertMinutes(seek));
}

function seek() {
  var seekedTime = $('#status-bar').val();
  player.pause();
  player.seek([seekedTime]);
  player.play();
}

function pause() {
  if(player != null) {
    player.pause();
    btnPlay.style.display = "block";
    btnPause.style.display = "none";
    pause_mode = true;
  }
}
  
function stop() {

  if(player != null) {

    status_seek = false;
    pause_mode = false;
    skip_mode = false;

    var table_name = getTableName();
    var rows = $(table_name).find('tbody').find('tr');
    for (var i = 0; i < rows.length; i++) {
      var row = $(rows[i]);
      var id = row.find('td:eq(1)').html();
      row.removeClass("itemSelected");
    }

    btnPlay.style.display = "block";
    btnPause.style.display = "none";

    $('#duration').text("0:00");
    $('#status').text("0:00");
    $('#status-bar').attr('max', 0);
    $('#status-bar').val(0);
    $('#volume-bar').val(1);
    $('#title').text("-");
    $('#artist').text("-");
    $('#image').attr("src","album_covers/fenix.jpg");
    $('#iconFavorite').attr('class', 'fa fa-heart fa-2x');

    $.ajax({
      type: 'GET',
      url: "api/unloadSong",
      dataType: 'json',
      async: false,
      success: function(result){
        var data = result;
      },
      error: function(result) {
        console.log(result);
      } 
    });

    player.stop();
    player.unload();
    player = null;

    lockControls();
  }
}

function skip_back() {
  song_index = parseInt(song_index);
  if(song_index <= 0) {
    toastr.warning("Can't keep going back");
  } else {
    skip_mode = true;
    var index_to_find = song_index - 1;
    var list = getList();
    $.each(list, function(index, value) {
      if(index_to_find == index) {
        song_index = index;
        song_id = value.id;
        title = value.title;
        artist = value.artist;
        album = value.album;
        year = value.year;
        genre = value.genre;
        time = value.time;
        image = value.image;
        favorite = value.favorite;
        date = value.creation_date;
        play();
      }
    });
  }
}

function skip_forward() {
  song_index = parseInt(song_index);
  if(song_index >= songs.length - 1) {
    toastr.warning("Can't keep getting ahead");
  } else {
    skip_mode = true;
    var index_to_find = song_index + 1;
    var list = getList();
    $.each(list, function(index, value) {
      if(index_to_find == index) {
        song_index = index;
        song_id = value.id;
        title = value.title;
        artist = value.artist;
        album = value.album;
        year = value.year;
        genre = value.genre;
        time = value.time;
        image = value.image;
        favorite = value.favorite;
        date = value.creation_date;
        play();
      }
    });
  }
}

function changeVolume(value) {
  Howler.volume(value);
}