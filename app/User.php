<?php

namespace App;

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
		if(Auth::user()->isAdmin()){
			return Section::with('pages');
		}
        return $this->belongsToMany('App\Section', 'permissions')->with('pages');
    }

	public function isAdmin(){
		return $this->admin;
	}
}
