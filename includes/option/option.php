<?php



self::$config['site']['title']           = "Jibres";
self::$config['site']['desc']            = "Jibres is not just an online accounting software; We try to create the best financial platform that has everything you need to sale and manage your financial life.";
self::$config['site']['slogan']          = "Integrated Sales and Online Accounting";
self::$config['site']['googleAnalytics'] = "UA-130946685-1";



// jibres after login redirect url
self::$config['redirect']        = 'store';

// store after login redirect
self::$config['store_redirect']  = '';

// first signup after signup redirect
self::$config['singup_redirect'] = 'store';





if(!defined('shaparak_user'))
{
	define('shaparak_user', '926028');
}

if(!defined('shaparak_pass'))
{
	define('shaparak_pass', '123456');
}
?>