<?php namespace App\Repositories;

use App\Order;
use Auth, Mail, Cache;

class OrderRepository {

	public function GetOrderById($id){
		return Order::find($id);
	}

	public function OrderPaymentApproved($id){
		$order = Order::find($id);
		$order->order_status = 2;
		if ($order->save()) {
			Cache::forget('orders');
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
		$orders = Cache::remember('orders', 10, function(){
			$user_id = Auth::user()->id;
			return Order::where('user_id', $user_id)->where('order_status', '<', 4)->orderBy('created_at', 'desc')->get();
		});
		return $orders;
	}

	public function GetPosters($order){
		$posters = Cache::remember('order_'.$order->id.'_posters', 10, function() use ($order){
			return $order->posters;
		});
		return $posters;
	}

}