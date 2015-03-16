<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use Auth, View;

class IndexController extends Controller {

	public function __construct(){
		$this->middleware('guest');

	}

	public function getIndex(){
		return view('index');
	}
}