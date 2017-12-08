<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	// The attributes that are mass assignable
	protected $fillable = ['user_id', 'section_id'];

    public $timestamps = false;
}
