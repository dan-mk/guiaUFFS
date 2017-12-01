<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class Useful
{
    public static function routeSection($route)
    {
		if(Session::has('section_subdomain') && session('section_subdomain') != ''){
		    return route($route, session('section_subdomain'));
		}
		return route("main.$route");
    }
}
