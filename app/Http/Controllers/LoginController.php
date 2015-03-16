<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

use Socialize, Auth, Request;

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

		return redirect('/home');

	}
	private function getAuthorizationFirst($service)
    {
        return Socialize::with($service)->redirect();
    }

    private function getUser($service){
    	return $user = Socialize::with($service)->user();
    }
}