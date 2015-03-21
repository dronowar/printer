<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Poster extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $guarded = ['order_id', 'maket_status', 'poster_price'];

	//
	public static $maket_status = array(
    	0 => 'on_modaration',
    	1 => 'ready_to_print',
        2 => 'rejected',
    );

    public function order(){
    	return $this->belongsTo('Order');
    }

}
