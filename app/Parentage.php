<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parentage extends Model
{
    public static function getIndexedParentages()
	{
		$parentages = self::all();

		$p = [];
		foreach($parentages as $parentage){
			$p[$parentage->child] = $parentage->parent;
		}

		return $p;
	}
}
