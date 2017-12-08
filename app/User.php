<?php

namespace App;

use DB;
use Auth;
use App\Section;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
     * The sections that the user can modify.
     */
    public function sections()
    {
		if($this->isAdmin()){
			return DB::table('sections');
		}
        return $this->belongsToMany('App\Section', 'permissions');
    }

	/**
     * The sections that the user can modify.
     */
    public function sectionsWithPages()
    {
		if(Auth::user()->isAdmin()){
			return Section::with('pages', 'pages.page_versions');
		}
        return $this->belongsToMany('App\Section', 'permissions')->with('pages', 'pages.page_versions');
    }

	public function isAdmin(){
		return $this->admin;
	}
}
