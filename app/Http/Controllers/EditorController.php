<?php

namespace App\Http\Controllers;

use Auth;
use App\Section;
use Illuminate\Http\Request;

class EditorController extends Controller
{
	/**
     * Display a listing of pages available for editing.
     *
     * @return \Illuminate\Http\Response
     */
    public function pages()
    {
		$sections = Auth::user()->sections()->get();

		$data = [
			'active_pages' => 'active',
			'sections' => $sections
		];

        return view('editor.pages', $data);
    }

	/**
     * Display a listing of groups available for editing.
     *
     * @return \Illuminate\Http\Response
     */
    public function groups()
    {
		$data = [
			'active_groups' => 'active'
		];

        return view('editor.groups', $data);
    }
}
