<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;

class ViewComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->composer('user', function($view){
            //$view->with('user', array('name' => 'Joe', 'email' => 'a@a.com', 'photo' => 'aaa'));
            $view->with('user', Auth::user());
        });
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
