<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageVersion extends Model
{
	// The attributes that are mass assignable
	protected $fillable = ['title', 'content', 'page_id', 'user_id'];
}
