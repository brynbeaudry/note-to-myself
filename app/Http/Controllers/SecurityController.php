<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecurityController extends Controller
{
  public function toomany(){
    return view('toomanyattempts');

  }
}
