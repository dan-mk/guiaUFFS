<?php

namespace App\Http\Controllers;

use Auth;
use App\Section;
use App\Parentage;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$sections = Section::where('id', 1)->get();

        return view('admin.sections', compact(
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
		$parent_section = Section::find($request->parent_id ?? -1);

		if($parent_section == null){
			return redirect()->route('sections.index');
		}

        return view('admin.sections_create', compact(
			'parent_section', 'request'
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
			'subdomain' => 'required|max:64|regex:/^[a-z\d]+/',
			'name' => 'required',
			'parent_id' => 'required|numeric|exists:sections,id'
		]);

		$subdomain = strtolower($request->subdomain);
		$name = $request->name;
		$parent_id = intval($request->parent_id);
		$user_id = Auth::user()->id;

        $section_id = Section::create(compact(
			'subdomain', 'name', 'user_id'
		))->id;

		Parentage::create([
			'parent' => $parent_id,
			'child' => $section_id
		]);

		return redirect()->route('home', $subdomain);
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
    public function edit($section_id)
    {
		$section = Section::find($section_id);

		if($section == null){
			return redirect()->route('sections.index');
		}

		$parent_section = $section->parent();

        return view('admin.sections_edit', compact('parent_section', 'section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $section_id)
    {
		$section = Section::find($section_id);
		if($section == null){
			return redirect()->route('sectins.index');
		}

		$request->validate([
			'subdomain' => 'required|max:64|regex:/^[a-z\d]+',
			'name' => 'required',
			'parent_id' => 'required|numeric|exists:sections,id'
		]);

		$subdomain = strtolower($request->subdomain);
		$name = $request->name;
		$parent_id = intval($request->parent_id);
		$user_id = Auth::user()->id;

        $section->fill(compact(
			'subdomain', 'name', 'user_id'
		));
		$section->save();

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
