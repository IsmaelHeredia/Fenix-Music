/* Radio */

function play_station() {

  stop();
  stop_station();

  radio = new Howl({
      src: [link],
      html5: true,
      format: ["mp3", "aac"],
      onplay: function() {

        var table_name = getTableName();
        var rows = $(table_name).find('tbody').find('tr');
        for (var i = 0; i < rows.length; i++) {
          var row = $(rows[i]);
          var id = row.find('td:eq(1)').html();
          if(id == station_id) {
            row.addClass("itemSelected");
          }
        }

        btnPlay.style.display = "none";
        btnPause.style.display = "none";
    
        $('#duration').text("0:00");
        $('#image').attr("src","album_covers/fenix.jpg");

        $('#title').text(name);
        $('#title').marquee({duration: 8000});

        unlockRadioControls();

      },
      onloaderror: function(error) {
        toastr.error("Playback error occurred");
      }
    });

    radio.play();
}

function stop_station() {

  if(radio != null) {
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

    radio.stop();
    radio.unload();
    radio = null;

    lockControls();
  }

}

function skip_back_station() {
  station_index = parseInt(station_index);
  if(station_index <= 0) {
    toastr.warning("Can't keep going back");
  } else {
    skip_mode = true;
    var index_to_find = station_index - 1;
    var list = getList();
    $.each(list, function(index, value) {
      if(index_to_find == index) {
        station_index = index;
        station_id = value.id;
        name = value.name;
        link = value.link;
        categories = value.categories;
        play_station();
      }
    });
  }
}

function skip_forward_station() {
  station_index = parseInt(station_index);
  if(station_index >= stations.length - 1) {
    toastr.warning("Can't keep getting ahead");
  } else {
    skip_mode = true;
    var index_to_find = station_index + 1;
    var list = getList();
    $.each(list, function(index, value) {
      if(index_to_find == index) {
        station_index = index;
        station_id = value.id;
        name = value.name;
        link = value.link;
        categories = value.categories;
        play_station();
      }
    });
  }
}