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

    'qq' => [
        'client_id' => '1103433089',
        'client_secret' => 'UOxscJCrmkP4Jj8V',
        'redirect' => 'http://yourapp.com/auth/qq/callback'
    ],

    'weibo' => [
        'client_id' => '4097598921',
        'client_secret' => 'befded6a482360f968548435c84afd77',
        'redirect' => 'http://yourapp.com/auth/weibo/callback'
    ],

    'weixin' => [
        'client_id' => '1103433089',
        'client_secret' => 'UOxscJCrmkP4Jj8V',
        'redirect' => 'http://yourapp.com/auth/twitter/callback'
    ],

    'gxoauth' => [
        'client_id' => 'dummy',
        'client_secret' => 'dummy',
        'redirect' => 'dummy'
    ],

    'getui' => [
        'app_key'   => 'I6PRNljSSE7GecB0st62A3',
        'app_id'    => 'NTWu3l8YGpAo9pxInfbXn',
        'master_secret' => 'YWoLvj3vaX8cgfet4jNer6',
        'host' => 'http://sdk.open.api.igexin.com/apiex.htm',
        'app_icon' => "http://www.uwang.me/image/app_icon.png"
    ],

    'gxpush' => [

    ],

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

];
