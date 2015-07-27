<?php 

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/phpinfo', function(){
	return phpinfo();
});


Route::get('/home/test', 'HomeController@test');

Route::get('/', 'IndexController@getIndex');
Route::controller('login', 'LoginController');
Route::get('logout', function(){
	Auth::logout();
	return redirect('/');
});

Route::get('home', 'HomeController@index');
Route::get('poster/create', 'PosterController@create');
Route::post('poster/store', 'PosterController@store');
Route::get('poster/{id}/update', 'PosterController@update');
Route::get('poster/{id}/destroy', 'PosterController@destroy');

Route::get('payment/status', 'PaymentController@paymentStatus');
Route::get('payment/{order_id}', ['as' => 'payment', 'uses' => 'PaymentController@payment']);


/*
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
*/