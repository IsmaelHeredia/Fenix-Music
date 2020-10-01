<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public $timestamps = false;
	protected $table = "stations";
    protected $fillable = ['name', 'link', 'categories'];
}
