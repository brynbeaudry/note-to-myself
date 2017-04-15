<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
//These are the Eloquent Models
use App\Users;
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
        //$this->middleware('verified');
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
        if(Auth::user()->verified==0)
          return view('verification');



        //Going to return view "with data here."
        return view('home');
    }

    private function processImage($file, $userId){

      $ext = $file->guessClientExtension();
      if($ext!= "gif" or $ext != "jpg"){
        echo "You may only upload .jpg or .gif";
      }
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
    // Delete their old note and write whatever is in the box to the db
    private function processNote($note, $userId) {
        DB::table('notes')->where('userId', '=', $userId)->delete();
        DB::table('notes')->insert([
            ['text'=> $note, 'userId' => $userId]
        ]);
    }
    // Delete their old ToBeDone and write whatever is in the box to the db
    private function processTBD($tbd, $userId) {
        DB::table('tbds')->where('userId', '=', $userId)->delete();
        DB::table('tbds')->insert([
            ['text'=> $tbd, 'userId' => $userId]
        ]);
    }
    // Delete their old ToBeDone and write whatever is in the box to the db
    private function processWebsites($websites, $userId) {
        //dd($websites);
        DB::table('websites')->where('userId', '=', $userId)->delete();
        foreach($websites as $url) {
            //dd($url);
            if($url != null) {
                DB::table('websites')->insert([
                    ['url' => $url, 'userId' => $userId]
                ]);
            }
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

      if(isset($request->notes)) {
          $note = $request->notes;
          $this->processNote($note, $userId);
      }
        if(isset($request->tbd)) {
            $tbd = $request->tbd;
            $this->processTBD($tbd, $userId);
        }

        if(isset($request->website)) {
            $website = $request->website;
            $this->processWebsites($website, $userId);
        }
        $request->session()->regenerate();
      return view('home');
    }
}
