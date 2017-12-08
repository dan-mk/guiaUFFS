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

		if($section == null){
			return redirect()->route('pages.index');
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
			'address' => 'required|not_in:entrar,contribuir,sobre,editor,admin,sair',
			'title' => 'required',
			'content' => 'required',
			'section_id' => 'required|numeric|exists:sections,id'
		]);

		$address = strtolower($request->address);
		$title = $request->title;
		$content = $request->content;
		$section_id = intval($request->section_id);
		$user_id = Auth::user()->id;
		$hidden = isset($request->hidden);

		$allowed_to_create = Gate::allows('change-pages-in-section', Section::find($section_id));
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
			'address', 'user_id', 'section_id', 'hidden'
		))->id;
		PageVersion::create(compact(
			'title', 'content', 'page_id', 'user_id'
		));

		if($section_id == 1){
			return redirect()->route('main.page', $address);
		}
		return redirect()->route('page', [Section::find($section_id)->complete_subdomain(), $address]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$page = Page::with('section')->find($id);
		if($page == null){
			abort(404);
		}

        return redirect()->route('page', [$page->section->complete_subdomain(), $page->address]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($page_id)
    {
		$page = Page::with('section', 'page_versions')->find($page_id);

		if($page == null){
			return redirect()->route('pages.index');
		}

		$section = $page->section;

        return view('editor.pages_edit', compact('page', 'section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $page_id)
    {
		$page = Page::find($page_id);
		if($page == null){
			return redirect()->route('pages.index');
		}

		$request->validate([
			'address' => 'required',
			'title' => 'required',
			'content' => 'required',
		]);

		$address = strtolower($request->address);
		$title = $request->title;
		$content = $request->content;
		$user_id = Auth::user()->id;
		$hidden = isset($request->hidden);

		$allowed_to_change = Gate::allows('change-pages-in-section', Section::find($page->section_id));
		$page_doesnt_exist = ($page->address == $address or !Page::where([
		    ['address', '=', $address],
		    ['section_id', '=', $page->section_id],
		])->exists());

		$v = Validator::make(compact('address', 'allowed_to_change', 'page_doesnt_exist'), [
			'address' => 'required|max:255|regex:/^[a-z\d-]+$/',
			'allowed_to_change' => 'accepted',
			'page_doesnt_exist' => 'accepted'
		], [
			'allowed_to_change.accepted' => 'You are not allowed to make changes to this section',
			'page_doesnt_exist.accepted' => 'This address already exists in this section'
		]);
		$v->validate();

		$page->fill(compact(
			'address', 'hidden'
		));
		$page->save();

		PageVersion::create(compact(
			'title', 'content', 'page_id', 'user_id'
		));

		if($page->section_id == 1){
			return redirect()->route('main.page', $address);
		}
		return redirect()->route('page', [Section::find($page->section_id)->complete_subdomain(), $address]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($page_id)
    {
        if(Auth::user()->isAdmin()){
			Page::find($page_id)->forceDelete();
		}
		return redirect()->route('pages.index');
    }
}
