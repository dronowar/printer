<?php namespace App\Repositories;

use App\User;

class UserRepository {
 
    public function findByUseremailOrCreate($userData)
    {	
        //var_dump($userData);
    	$user = User::whereEmail($userData->email)->first();
    	if (empty($user)) {
	    	$user = new User;
	    	$user->email = $userData->email;
	    	$user->name = $userData->name;
	    	$user->photo = $userData->avatar;
	    	$user->active = true;
	    	$user->save();
            //mail
    	}
    	return $user;
    }
}