<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $guarded = ['*'];
	
	public static $order_status = array(
    	0 => 'new',
    	1 => 'payment_required',
    	2 => 'inprogress',
    	3 => 'completed',
    	4 => 'delivered',
    	5 => 'deleted',
    	);

	//

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function posters(){
        return $this->hasMany('App\Poster');
    }
/*
    public function CurrentUserOrders(){

    }
*/
}
