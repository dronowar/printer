<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'User',
		'secret' => '',
	],

	'google' => [
		'client_id'     => '402821806731-bdf87ole30i8450njss5lt6fh4ttn4p2.apps.googleusercontent.com',
    	'client_secret' => 'RQkfzT_Xgw09Bz_VpwGo991M',
    	'redirect' 		=> 'http://dronowar.no-ip.org/login/google',
    	//'scope'         => array('email', 'profile'),
	],
	'facebook' => [
		'client_id'	 => '1598590817046221',
		'client_secret' => '09fc376e4b086c7082180c30ddd61a68',
		'redirect' 		=> 'http://dronowar.no-ip.org/login/facebook',
	]

];
