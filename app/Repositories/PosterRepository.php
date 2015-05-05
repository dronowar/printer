<?php namespace App\Repositories;

use App\Poster;
use App\Order;
use Auth, Mail, Cache;

class PosterRepository {

	protected $cache_on;

	public function __construct() {
		$this->cache_on = config('cache.enable');
	}

	public function CreateNewPoster($req){
		$user = Auth::user();
		$order = Order::where('user_id', '=', $user->id)->where('order_status', 0)->first();
		if (empty($order)) {
			$order = new Order;
			$order->user_id = $user->id;
			$order->order_status = 0;
			$order->order_price = 2500;
			$order->delivery_adress = 'Россия, г.Тула, ул. Складская, дом 1';
			if($order->save()){
				if($this->cache_on) Cache::forget('orders_'.$user->id);
			}
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
		if ($poster->save()) {
			if($this->cache_on) Cache::forget('order_'.$poster->order_id.'_posters');
			Mail::queue('emails.newPoster', [
				'order_id' => $order->id, 
				'created_at' => (string)$order->created_at, 
				'name' => $user->name,
				'order_price' => $order->order_price,
				'poster_maket_url' => $poster->maket_url,
				'poster_price' => $poster->poster_price,
				'poster_w' => $poster->w,
				'poster_h' => $poster->h,
				'poster_colors' => $poster->colors,
				'poster_paper_id' => $poster->paper_id,
				'poster_quantity' => $poster->quantity
				], function($message) use ($user) {
			    	$message->to($user->email, $user->name)->subject('Onpopri: Новый постер');
			});
			return true;
		}
		return false;
	}

	public function DestroyPoster($id){
		$poster = Poster::find($id);
		if ($poster->destroy($id)){
			$order_id = $poster->order_id;
			if($this->cache_on) Cache::forget('order_'.$order_id.'_posters');
			$count = Poster::where('order_id', $order_id)->count();
			if($count == 0) {
				$order = Order::find($order_id);
				if ($order->destroy($order_id)){
					if($this->cache_on) Cache::forget('orders_'.$order->user_id);
				} else return false;
			}
			return true;
			}
		return false;
	}

	public function UpdateUrl($id, $url){
		
		$poster = Poster::find($id);
		$poster->maket_url = $url;
		$poster->maket_status = 0;
		if ($poster->save()) {
			$order_id = $poster->order_id;
			if($this->cache_on) Cache::forget('order_'.$order_id.'_posters');
			Mail::queue('emails.updateUrl', ['order_id' => $order_id, 'maket_url' => $poster->maket_url], function($message)
			{
			    $message->to('admin@onpopri.com', 'Admin')->subject('Onpopri: Обвновлена ссылка на макет');
			});
			return true;
		}
		return false;
	}

}