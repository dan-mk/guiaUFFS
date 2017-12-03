<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;

class PublicController extends Controller
{
	/**
     * Show the public home of a section
     *
     * @return \Illuminate\Http\Response
     */
    public function home($subdomain = '')
    {
		$section_id = Section::getSection($subdomain);
		if(!$section_id){
			abort(404);
		}
		$section = Section::find($section_id);
		session(['section_subdomain' => $section->subdomain]);

		$title = $section->name;

        return view('home', compact(
			'title', 'section'
		));
    }

	/**
     * Show a public page of a section
     *
     * @return \Illuminate\Http\Response
     */
    public function page($section, $page)
    {
        return $section . '-' . $page;
    }
}
