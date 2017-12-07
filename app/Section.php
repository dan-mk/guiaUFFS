<?php

namespace App;

use App\Parentage;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
	public function pages()
	{
		return $this->hasMany('App\Page');
	}

	public function parent()
	{
		return $this->belongsToMany('App\Section', 'parentages', 'child', 'parent')->first();
	}

	public function children()
	{
		return $this->belongsToMany('App\Section', 'parentages', 'parent', 'child');
	}

	public static function getSection($subdomain)
	{
		$sections = self::getIndexedSections();
		$parentages = Parentage::getIndexedParentages();

		$available_subdomains = [];
		foreach($sections as $section){
			$subd = $section->subdomain;
			$id = $section->id;
			while(isset($parentages[$id]) && $parentages[$id] != 1){
				$id = $parentages[$id];
				$subd .= ".{$sections[$id]->subdomain}";
			}
			$available_subdomains[$section->id] = $subd;
		}

		return array_search("$subdomain", $available_subdomains);
	}

	public static function getIndexedSections()
	{
		$sections = self::all();

		$s = [];
		foreach($sections as $section){
			$s[$section->id] = $section;
		}

		return $s;
	}
}
