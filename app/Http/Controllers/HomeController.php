<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//These are the Eloquent Models
use App\Note;
use App\Image;
use App\TBD;
use App\Website;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Going to return view "with data here."
        return view('home');
    }

    public function save(Request $request){
      // this gets called when you press save on the user's home page
      //For now, since there is only one save button in jason's example
      //Delete everyhing from the Database and and put the new input back into the database. You can "show tables" in mysql and "describe <table anme>" to see what
      //The desposied models look like. Or check out the migrations to see what they look like
      //REmeber, the dasboard, for now, is basically  a form. When it's loaded the form should be populated by what was in the database. When it's saved, the database should be filled with the data from the form. This is where we start,a nd then we have to meet all jason's little requirements.

    }
}
