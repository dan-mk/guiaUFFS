<?php

namespace App\Http\Controllers;

use Auth;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function add($section_id, $user_id){
		$permission = Permission::where('section_id', '=', $section_id)->where('user_id', '=', $user_id)->first();

		if($permission == null && Auth::user()->isAdmin()){
			Permission::create(compact(
				'section_id', 'user_id'
			));
		}

		return redirect()->route('sections.index');
	}

	public function remove($section_id, $user_id){
		$permission = Permission::where('section_id', '=', $section_id)->where('user_id', '=', $user_id)->first();

		if($permission != null && Auth::user()->isAdmin()){
			$permission->forceDelete();
		}

		return redirect()->route('sections.index');
	}
}
