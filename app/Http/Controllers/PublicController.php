<?php

namespace App\Http\Controllers;

use App\Section;
use App\Libraries\JBBCode;
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
		session(['section_subdomain' => $section->complete_subdomain()]);

		$title = $section->name;
		$pages = $section->pages()->where('hidden', '=', false)->get();

		$section_parent = $section->parent();
		$section_children = $section->children()->get();

        return view('home', compact(
			'title', 'section', 'pages', 'section_parent', 'section_children'
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
		session(['section_subdomain' => $section->complete_subdomain()]);

		$page = $section->pages()->where('address', '=', $page_address)->with('page_versions')->first();

		if($page == null or $page->hidden == true){
			abort(404);
		}

		$page_version = $page->page_versions->first();
		$title = $page_version->title;

		$parser = new JBBCode\Parser();
		$parser->addCodeDefinitionSet(new JBBCode\CustomCodeDefinitionSet());

		$page_version->content = nl2br($parser->parse($page_version->content)->getAsHtml());

		preg_match_all('/<h2 id="(.+)">(.+)<\/h2>/', $page_version->content, $matches);

		$subtitles = $matches[2];
		$subtitles_ids = $matches[1];

		$pages_menu = $section->pages()->where('hidden', '=', false)->get();

        return view('page', compact(
			'title', 'section', 'page', 'page_version', 'subtitles', 'subtitles_ids', 'pages_menu'
		));
    }
}
