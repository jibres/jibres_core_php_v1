<?php
require_once('server.php');
require_once('api.php');
require_once('social.php');
require_once('payment.php');
require_once('sms.php');

/**
 * try to fix url and set some settings of them like slash, www or fix tld or use main domain
 */
// on set below value to off, skip all of this part
self::$url['fix']   = true;

// if true set www else try to remove from url
self::$url['www']   = false;

// if true add slash at end of url, else remove
self::$url['slash'] = false;

// self::$url['tld']               = 'com';
self::$url['protocol']                   = 'https';

self::$config['site']['title']           = "Jibres";
self::$config['site']['desc']            = "Jibres is not just an online accounting software; We try to create the best financial platform that has everything you need to sale and manage your financial life.";
self::$config['site']['slogan']          = "Integrated Sales and Online Accounting";
self::$config['site']['googleAnalytics'] = "UA-130946685-1";

self::$config['billing_page']   = true;
self::$config['billing_charge'] = true;
self::$config['address_page']   = true;

self::$config['botscout']                 = 'hIenwLNiGpPOoSk';

// the project have help center or no
self::$config['help_center']         = true;

// for example posts, tags, term , ...
self::$config['cms'] = true;
self::$config['visitor'] = false;
/**
@ In the name Of Allah
* The base configurations of the jibres.
*/
self::$language =
[
	'default' => 'fa',
	'list'    => ['fa','en',],
];
/**
 * system default lanuage
 */

self::$config['coming']           = false;

self::$config['debug']                        = false;

self::$config['redirect']                     = 'store';

/**
 * first signup url
 * main redirect url . signup redirect url
 */
self::$config['enter']['singup_redirect']     = 'store';


self::$config['favicon']['version']           = null;


/**
 * call kavenegar template
 */
self::$config['enter']['call']                = true;
self::$config['enter']['call_template_fa'] = 'ermile-fa';
self::$config['enter']['call_template_en'] = 'ermile-en';



/**
 * cronjob urls and status
 */
self::$config['cronjob']['status'] = true;



/**
 * list of units
 */
self::$config['units'] =
[
	1 =>
	[
		'title' => 'toman',
		'desc'  => "Toman",
	],

	2 =>
	[
		'title' => 'dollar',
		'desc'  => "$",
	],
];
// the unit id for default
self::$config['default_unit'] = 1;
// force change unit to this unit
self::$config['force_unit']   = 1;

/**
 * transaction code
 */
self::$config['transactions_code'][100] = "invoice:store";
self::$config['transactions_code'][150] = "promo:ref";

self::$config['enter']['verify_telegram'] = true;
self::$config['enter']['verify_sms']      = true;
self::$config['enter']['verify_call']     = true;
self::$config['enter']['verify_sendsms']  = false;


// every wrong pass or code wate for ? [second]
self::$config['enter']['wait']                         = 10;
// life time code for ? [second]
self::$config['enter']['life_time_code']               = 60 * 5;
// after signup user redirect to different page
// self::$config['enter']['signup_redirect']              = null;
// after signup user redirect to different page
self::$config['enter']['singup_username']              = false;
// save remember me to login
self::$config['enter']['remember_me']              = true;


// ----- favicon option
self::$config['favicon']['complete']                   = true;
self::$config['favicon']['version']                    = 1;




if(!defined('shaparak_user'))
{
	define('shaparak_user', '926028');
}

if(!defined('shaparak_pass'))
{
	define('shaparak_pass', '123456');
}
?>