<?php namespace App\Repositories;

use User;

class UserRepository {
 
    public function findByUseremailOrCreate($userData)
    {	
    	$user = User::whereEmail($userData->email)->first();
    	if (empty($user)) {
	    	$user = new User;
	    	$user->email = $userData['email'];
	    	$user->name = $userData['name'];
	    	$user->photo = $userData['picture'];
	    	$user->active = true;
	    	$user->save();
    	}
    	return $user;
    }
}