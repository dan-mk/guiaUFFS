<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	// The attributes that are mass assignable
	protected $fillable = ['address', 'user_id', 'section_id'];

	public function section()
	{
		return $this->belongsTo('App\Section');
	}

	public function page_versions()
	{
		return $this->hasMany('App\PageVersion');
	}
}
