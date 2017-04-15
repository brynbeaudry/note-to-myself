<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        /*
        $images = Image::where('userId', "=", $userId)->get();
        $img_urls = array();
        foreach($images as $image){
            array_push($img_urls, $image->url);
        }
        */



        //Going to return view "with data here."
        return view('home');
    }

    private function processImage($file, $userId){

      $ext = $file->guessClientExtension();
      $newImgId = DB::table('images')->max('id');
      if($newImgId==null) $newImgId = 0;
      $newImgId++;
      $path = $file->move("images/{$userId}" , "{$newImgId}.{$ext}");
      //Storage::setVisibility($path, 'public');
      //dd($path);
      DB::table('images')->insert([
        ['path' => $path, 'userId' => $userId ]
      ]);
    }

    private function deleteChecked($checkBoxArray){
      foreach ($checkBoxArray as $key => $value) {
        $toDel=Image::findOrFail($value);
        $toDel->delete();
      }
    }

    public function save(Request $request){
      // this gets called when you press save on the user's home page
      //For now, since there is only one save button in jason's example
      //Delete everyhing from the Database and and put the new input back into the database. You can "show tables" in mysql and "describe <table anme>" to see what
      //The desposied models look like. Or check out the migrations to see what they look like
      //REmeber, the dasboard, for now, is basically  a form. When it's loaded the form should be populated by what was in the database. When it's saved, the database should be filled with the data from the form. This is where we start,a nd then we have to meet all jason's little requirements.
      $userId = Auth::user()->id;
      //Dealing with Uploaded file
      if(isset($request->file)){
        $file = $request->file('file');
        $this->processImage($file, $userId);
      }
      if(isset($request->checkboxDel)){
        $this->deleteChecked($request->checkboxDel);
      }


      return view('home');
    }
}
