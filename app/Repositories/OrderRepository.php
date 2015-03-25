<?php namespace App\Repositories;

use App\Order;
use Auth, Mail;

class OrderRepository {

	public function GetOrderById($id){
		return Order::find($id);
	}
	public function OrderPaymentApproved($id){
		$order = Order::find($id);
		$order->order_status = 2;
		if ($order->save()) {
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

}