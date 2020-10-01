<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    public $timestamps = false;
	protected $table = "playlists";
    protected $fillable = ['name'];
}
