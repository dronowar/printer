<?php namespace App\Repositories;

use App\User;
use Cache, Mail;

class UserRepository {
 
    public function findByUseremailOrCreate($userData)
    {	
        //ищем пользователя с таким e-mail-ом
    	$user = User::whereEmail($userData->email)->first();
        //если такого нет, создаем нового
    	if (empty($user)) {
	    	$user = new User;
	    	$user->email = $userData->email;
	    	$user->name = $userData->name;
	    	$user->photo = $userData->avatar;
	    	$user->active = true;
	    	$user->save();
            //пользователь создан нужно его поприветсвовать на e-mail
            Mail::queue('emails.wellcome', [
                'name' => $user->name
            ], function($message) use ($user)
            {
                $message->to($user->email, $user->name)->subject('Добро пожаловать в Onpopri!');
            });
    	}
        //возвращаем либо найденного пользователя либо свежесозданного
    	return $user;
    }

}