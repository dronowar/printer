<?php namespace App\Repositories;

use App\Order;
use Auth;

class OrderRepository {

	public function GetOrderById($id){
		return Order::find($id);
	}
	public function OrderPaymentApproved($id){
		$order = Order::find($id);
		$order->order_status = 2;
		if ($order->save()) return true;
		return false;
	}

}