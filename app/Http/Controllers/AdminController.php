<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	/**
     * In the future, when more things are added, it could be a dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return redirect()->route('sections.index');
    }
}
