<?php namespace App\Repositories;

use App\Order;
use Auth, Mail, Cache;

class OrderRepository {

	protected $cache_on, $cache_time;

	public function __construct() {
		$this->cache_on = config('cache.enable');
		$this->cache_time = config('cache.time');
	}

	public function GetOrderById($id){
		return Order::find($id);
	}

	public function OrderPaymentApproved($id){
		$order = Order::find($id);
		$order->order_status = 2;
		if ($order->save()) {
			Cache::forget('orders_'.$order->user_id);
			Mail::queue('emails.paymentApproved', [
				'order_id' => $order->id, 
				'created_at' => $order->created_at, 
				'name' => $order->user->name, 
				'order_price' => $order->order_price,
			], function($message) use ($order)
			{
				$message->to($order->user->email, $order->user->name)->subject('Onpopri: Заказ оплачен');
			});
			return true;
		}
		return false;
	}

	public function GetActiveOrders(){
		$user_id = Auth::id();
		if($this->cache_on){
		return Cache::remember('orders_'.$user_id, $this->cache_time, function() use ($user_id) {
			return $this->ActiveOrders($user_id);
		});
		} else return $this->ActiveOrders($user_id);
	}

	public function GetPosters($order){
		if($this->cache_on){
		return Cache::remember('order_'.$order->id.'_posters', $this->cache_time, function() use ($order){
			return $this->Posters($order);
		});
		} else return $this->Posters($order);
	}

	private function ActiveOrders($user_id){
		return Order::where('user_id', $user_id)->where('order_status', '<', 4)->orderBy('created_at', 'desc')->get();
	}

	private function Posters($order){
		return $order->posters;
	}

}