<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Poster extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = ['url', 'w', 'h', 'quantity'];

	//
	public static $maket_status = array(
    	0 => 'on_modaration',
    	1 => 'rejected',
    	2 => 'ready_to_print',
    );

}
