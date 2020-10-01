<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public $timestamps = false;
	protected $table = "songs";
    protected $fillable = ['title', 'artist', 'album','year','genre','time','image','favorite','amount_listened','path','creation_date'];
}
