<?php

namespace App\Http\Controllers;

use Auth;
use App\Page;
use Validator;
use App\Section;
use App\PageVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$sections = Auth::user()->sectionsWithPages()->get();

        return view('editor.pages', compact(
			'sections'
		));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		$section = Section::find($request->section_id ?? -1);

		if(!$section){
			return redirect()->route('paginas.index');
		}

        return view('editor.pages_create', compact(
			'section', 'request'
		));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$request->validate([
			'address' => 'required',
			'title' => 'required',
			'content' => 'required',
			'section_id' => 'required|numeric|exists:sections,id'
		]);

		$address = strtolower($request->address);
		$title = $request->title;
		$content = $request->content;
		$section_id = intval($request->section_id);
		$user_id = Auth::user()->id;

		$allowed_to_create = Gate::allows('create-page', Section::find($section_id));
		$page_doesnt_exist = !Page::where([
		    ['address', '=', $address],
		    ['section_id', '=', $section_id],
		])->exists();

		$v = Validator::make(compact('address', 'allowed_to_create', 'page_doesnt_exist'), [
			'address' => 'required|max:255|regex:/^[a-z\d-]+$/',
			'allowed_to_create' => 'accepted',
			'page_doesnt_exist' => 'accepted'
		], [
			'allowed_to_create.accepted' => 'You are not allowed to make changes to this section',
			'page_doesnt_exist.accepted' => 'This address already exists in this section'
		]);
		$v->validate();

		$page_id = Page::create(compact(
			'address', 'user_id', 'section_id'
		))->id;
		PageVersion::create(compact(
			'title', 'content', 'page_id', 'user_id'
		));

		return redirect()->route('paginas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
