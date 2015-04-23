<?php namespace App\Http\Controllers;

use App\Repositories\OrderRepository;

use Auth, App\Order;
use Mail, Log, Queue;

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
	public function __construct(OrderRepository $order)
	{
		$this->middleware('auth');
		$this->order = $order;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */

	public function test(){
		$s = microtime(true);
		Mail::queue('emails.newOrder', ['order_id' => 1, 'created_at' => 1, 'name' => 1], function($message) 
				{
				    $message->to('c@c.com', '1')->subject('Onpopri: Новый заказ');
				});
		return 'message send'.(microtime(true) - $s);
	}

	public function index()
	{	
		
		$orders = $this->order->GetActiveOrders();
		$v = $orders->toArray();
		$i=0;
		foreach ($orders as $order) {
			$posters = $this->order->GetPosters($order);
			$v[$i]['posters'] = $posters->toArray(); 
			$i++;
		}
		//dd($v);
		//\Debugbar::info($orders);
		return view('home')->with('orders', $v);
	}
}