<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth, Cache, Session;

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
			/*			
					$token = Session::get('_token');
					if(Cache::has($token)) {
						$user = Cache::get($token);
						//dd($user);
					}
					else {
						$user = Auth::user();
						Cache::add($token, $user, 30);
						
	           		}

            		$view->with('user', $user);
     		*/
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
