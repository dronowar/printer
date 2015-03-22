<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

use Socialize, Auth, Request, Session;

class LoginController extends Controller {

	private $users;
	
	public function __construct(UserRepository $users){
		$this->users = $users;
	}

	public function getIndex(){
		return redirect('/');
	}

	public function getGoogle(){
		return $this->loginOrCreateUser('google');
	}

	private function loginOrCreateUser($service){
		if (!Request::has('code')) return $this->getAuthorizationFirst($service);

		$user = $this->users->findByUseremailOrCreate($this->getUser($service));

		Auth::login($user, true);
		if(Session::has('maket_url')) return redirect('/poster/create');
		return redirect('/home');

	}
	private function getAuthorizationFirst($service)
    {	
    	if($maket_url = Request::get('maket_url')) Session::put('maket_url', $maket_url);
        return Socialize::with($service)->redirect();
    }

    private function getUser($service){
    	return $user = Socialize::with($service)->user();
    }
}