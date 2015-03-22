<?php namespace App\Http\Controllers;

use Auth, App\Order;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

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
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */

	public function test(){
		return redirect('/home')->with('message.error', 'test info');
	}

	public function index()
	{	
		$user_id = Auth::user()->id;
		$orders = Order::where('user_id', $user_id)->where('order_status', '<', 4)->orderBy('created_at', 'desc')->get();
		//\Debugbar::info(Order::find(1)->posters);
		return view('home')->with('orders', $orders);
	}
}