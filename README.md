# Fenix Music

This project was made with Laravel 7 and MySQL, it has the following functions:

* Play MP3 music locally
* You can play streams or radios.
* Organize playlists by each folder
* Choose favorite songs

To add new songs, they must go to the "Settings" section, from there they must choose the directory where they save all their music, the program recognizes each folder as a playlist and its MP3 files as songs from that playlist.
To add new stations, you must import a JSON file with content like this:

```
[
  {
    "name": "Alternative Rock",
    "link": "http://7579.live.streamtheworld.com:80/977_ALTERN_SC",
    "categories": "Rock"
  }
]
```

In addition, a file called stations.json is already included in the project as stations by default.

Installation:

Download the project from github either by normal download or by git clone.

Once in the project, to generate the vendor folder use the following command:

composer install

To generate the node_modules folder use the following command:

npm install 

Rename the .env.example file to just .env and edit the MySQL server configuration values

Now generate the key with the following command:

php artisan key:generate

To create the tables in the database use the following command:

php artisan migrate 

To generate the default admin user use the following command:

php artisan db:seed --class=DatabaseSeeder 

The password is also admin.

With that the installation would be done, you can enter the system and from "settings" scan all your music and import the stations.json file for the streams.

Some pictures:

![screenshot](https://1.bp.blogspot.com/--SMdNRLz3aI/X3eAPFJxGDI/AAAAAAAABr8/9juNdG1ChH8OSoqicrvse2OqVb8AhnGFQCLcBGAsYHQ/s1432/fenixmusic1.jpg)

![screenshot](https://1.bp.blogspot.com/-nmw2ziWHBuk/X3eAPV5_M0I/AAAAAAAABsA/efJH71yOFVIElKVIVfFdo-m_hHjoJK7CwCLcBGAsYHQ/s1432/fenixmusic2.jpg)

![screenshot](https://1.bp.blogspot.com/-lzOX331k5DE/X3eAO-mE2yI/AAAAAAAABr4/-AlI_3PTy-UWdT_XYLlTZEZnnjm5AwJaACLcBGAsYHQ/s1432/fenixmusic3.jpg)
