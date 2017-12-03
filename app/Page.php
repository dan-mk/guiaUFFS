<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	public function section()
	{
		return $this->belongsTo('App\Section');
	}

	public function page_versions()
	{
		return $this->hasMany('App\PageVersion');
	}
}
