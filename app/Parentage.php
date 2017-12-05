<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parentage extends Model
{
	public function parent_rel()
	{
		return $this->hasOne('App\Section', 'id', 'parent');
	}

	public function child_rel()
	{
		return $this->hasOne('App\Section', 'id', 'child');
	}

    public static function getIndexedParentages(){
		$parentages = self::all();

		$p = [];
		foreach($parentages as $parentage){
			$p[$parentage->child] = $parentage->parent;
		}

		return $p;
	}
}
