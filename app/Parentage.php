<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parentage extends Model
{
	// The attributes that are mass assignable
	protected $fillable = ['parent', 'child'];

	public $timestamps = false;

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
