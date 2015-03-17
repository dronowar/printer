<?php namespace App\Repositories;

use App\Poster;
use App\Order;
use Auth;


class PosterRepository {

	public function CreateNewPoster($req){
		$user_id = Auth::user()->id;
		$order = Order::where('user_id', '=', $user_id)->where('order_status', 0)->first();
		if (empty($order)) {
			$order = new Order;
			$order->user_id = $user_id;
			$order->order_status = 0;
			$order->order_price = 2500;
			$order->delivery_adress = '';
			$order->save();
		}
		$poster = new Poster;
		$poster->order_id = $order->id;
		$poster->maket_status = 0;
		$poster->poster_price = 1500;
		$poster->w = $req['w'];
		$poster->h = $req['h'];
		$poster->paper_id = $req['paper_id'];
		$poster->colors = $req['colors'];
		$poster->maket_url = $req['maket_url'];
		$poster->quantity = $req['quantity'];
		//$poster = Poster::create($req);
		$poster->save();
		
		//if ($poster = Poster::find($poster->id)) $order = $poster->order()->first();
		//$poster = Order::where('poster_id', $poster_id)->posters()->get();
		//\Debugbar::info('poster='.serialize($poster));
		\Debugbar::info($order);
		return $poster;
	}

}