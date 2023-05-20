<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
	use HasFactory;
	
    public $timestamps = false;

	protected $table = "songs";
    protected $fillable = ['title', 'artist', 'album','year','genre','time','image','favorite','amount_listened','path','creation_date'];
}
