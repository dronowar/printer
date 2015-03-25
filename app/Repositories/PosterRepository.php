<?php namespace App\Repositories;

use App\Poster;
use App\Order;
use Auth, Mail, Log;

class PosterRepository {

	public function CreateNewPoster($req){
		$user = Auth::user();
		//$user_id = $user()->id;
		$order = Order::where('user_id', '=', $user->id)->where('order_status', 0)->first();
		if (empty($order)) {
			$order = new Order;
			$order->user_id = $user->id;
			$order->order_status = 0;
			$order->order_price = 2500;
			$order->delivery_adress = 'Россия, г.Тула, ул. Складская, дом 1';
			if($order->save()){
				Mail::queue('emails.newOrder', ['order_id' => $order->id, 'created_at' => $order->created_at, 'name' => $user->name], function($message)
				{
				    $message->to($user->email, $user->name)->subject('Onpopri: Новый заказ');
				});
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
		//$poster = Poster::create($req);
		if ($poster->save()) return true;
		return false;
	}

	public function DestroyPoster($id){
		$poster = Poster::find($id);
		$order_id = $poster->order_id;
		if ($poster->destroy($id)){
			$count = Poster::where('order_id', $order_id)->count();
			if($count == 0) Order::destroy($order_id);
			return true;
			}
		return false;
	}

	public function UpdateUrl($id, $url){
		
		$poster = Poster::find($id);
		$poster->maket_url = $url;
		$poster->maket_status = 0;
		Log::info(microtime(true) - $s);
		if ($poster->save()) {
			Log::info(microtime(true) - $s);
			Mail::queue('emails.updateUrl', ['order_id' => $poster->order_id, 'maket_url' => $poster->maket_url], function($message)
			{
			    $message->to('admin@onpopri.com', 'Admin')->subject('Onpopri: Обвновлена ссылка на макет');
			});
			Log::info(microtime(true) - $s);
			return true;
		}
		return false;
	}

}