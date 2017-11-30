<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
	/**
     * Show the public home of a section
     *
     * @return \Illuminate\Http\Response
     */
    public function home($section = '')
    {
        return $section;
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
