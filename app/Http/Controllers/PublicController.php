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
		$pages = $section->pages()->where('hidden', '=', false)->get();

        return view('home', compact(
			'title', 'section', 'pages'
		));
    }

	/**
     * Show a public page of a section
     *
     * @return \Illuminate\Http\Response
     */
    public function page($subdomain, $page_address)
    {
		$section_id = Section::getSection($subdomain);
		if(!$section_id){
			abort(404);
		}
		$section = Section::find($section_id);
		session(['section_subdomain' => $section->subdomain]);

		$page = $section->pages()->where('address', '=', $page_address)->with('page_versions')->first();

		if($page == null or $page->hidden == true){
			abort(404);
		}

		$page_version = $page->page_versions->first();
		$title = $page_version->title;

        return view('page', compact(
			'title', 'section', 'page', 'page_version'
		));
    }
}
