<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorController extends Controller
{
	/**
     * In the future, when more things are added, it could be a dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return redirect()->route('pages.index');
    }
}
