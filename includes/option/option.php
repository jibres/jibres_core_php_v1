<?php



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


self::$config['coming']           = false;


// jibres after login redirect url
self::$config['redirect']        = 'store';

// store after login redirect
self::$config['store_redirect']  = '';

// first signup after signup redirect
self::$config['singup_redirect'] = 'store';


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
self::$config['enter']['verify_sendsms']  = true;


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




/**
* cofig of zarinpal payment
*/
self::$config['zarinpal']['status']      = true;
self::$config['zarinpal']['MerchantID']  = "325ffbdc-664a-11e8-acce-005056a205be";
self::$config['zarinpal']['Description'] = "Jibres";
// set the call back is null to redirecto to default dash callback payment
self::$config['zarinpal']['CallbackURL'] = null;
// all amount of this payment * exchange of this payment to change all units to default units of dash
self::$config['zarinpal']['exchange']    = 1;


/**
* cofig op pay.ir
*/
self::$config['payir']['status']   = false;
self::$config['payir']['api']      = "3c350829ff1161278c63640a798f2daf";
self::$config['payir']['redirect'] = null;


/**
* config of parsian payment
*/
self::$config['parsian']['status']       = true;
self::$config['parsian']['LoginAccount'] = 'ybX2rEgJ187vVPh83FT2'; // jibres payment
// set the call back is null to redirecto to default dash callback payment
self::$config['parsian']['CallBackUrl']  = null;
// all amount of this payment * exchange of this payment to change all units to default units of dash
self::$config['parsian']['exchange']     = 10;


/**
* config of irkish payment
*/
self::$config['irkish']['status']      = true;
self::$config['irkish']['merchantId']  = 'C3FC'; // jibres
// set the call back is null to redirecto to default dash callback payment
self::$config['irkish']['revertURL']   = null;
self::$config['irkish']['description'] = 'jibres.com';
self::$config['irkish']['paymentId']   = null;
self::$config['irkish']['sha1']        = '22338240992352910814917221751200141041845518824222260'; // main



self::$config['asanpardakht']['status']           = true;
self::$config['asanpardakht']['MerchantID']       = '3833817';
self::$config['asanpardakht']['MerchantConfigID'] = '4358';
self::$config['asanpardakht']['Username']         = 'jibrs3833817';
self::$config['asanpardakht']['Password']         = 'TFIHOc7';
self::$config['asanpardakht']['EncryptionKey']    = 'fkAD0Ebq8P2fvqpIkULhAuLJ12Av5GnXpJXxMRTTXIk=';
self::$config['asanpardakht']['EncryptionVector'] = 'G4TOobPmmVp/P6U5VuRs+tERgFoA9gm3MbcFxXMhDg8=';
self::$config['asanpardakht']['MerchantIP']       = '138.68.96.140';
self::$config['asanpardakht']['MerchantName']     = 'JIBRES';




self::$config['sep']['status']   = true;
self::$config['sep']['MID']      = 31064728;
self::$config['sep']['Password'] = 8473172;




/**
* the social network
*/
self::$social['status']                       = true;

self::$social['list']['telegram']             = 'jibres';
self::$social['list']['facebook']             = 'jibres';
self::$social['list']['twitter']              = 'ermile_jibres';
self::$social['list']['instagram']            = 'ermile_jibres';
// self::$social['list']['googleplus']           = '113130164586721131168';
self::$social['list']['github']               = 'jibres';
self::$social['list']['linkedin']             = null;
self::$social['list']['aparat']               = 'jibres';

/**
* TELEGRAM
* t.me
*/
self::$social['telegram']['status']           = true;
self::$social['telegram']['bot']        = 'JibresBot';
self::$social['telegram']['hookFolder'] = 'Halllooooo';
self::$social['telegram']['token']      = '731332936:AAECREdVLCAJqzwTtCJnst_v293LtDSaiKc';
self::$social['telegram']['debug']      = true;
self::$social['telegram']['tunnel']     = true;


// /**
// * FACEBOOK
// */
// self::$social['facebook']['status']           = true;
// self::$social['facebook']['name']             = 'jibres';
// self::$social['facebook']['key']              = null;
// self::$social['facebook']['app_id']           = '236377626849014';
// self::$social['facebook']['app_secret']       = 'c7055125a0e70d2125664b009df3f3cd';
// self::$social['facebook']['api_version']      = '2.9';
// self::$social['facebook']['redirect_url']     = null;
// self::$social['facebook']['required_scope']   = null;
// self::$social['facebook']['page_id']          = null;
// self::$social['facebook']['access_token']     = null;
// self::$social['facebook']['client_token']     = 'df0047eb1af1e2acba2a3645bcb4f472';

// /**
// * GOOGLE
// */
// self::$social['google']['status']                      = false;
// self::$social['google']['client_id']                   = '395232553225-5filcn07d2rdjl2fld57mf8e50ac146j.apps.googleusercontent.com';
// self::$social['google']['project_id']                  = 'ermile-jibres';
// self::$social['google']['auth_uri']                    = 'https://accounts.google.com/o/oauth2/auth';
// self::$social['google']['token_uri']                   = 'https://accounts.google.com/o/oauth2/token';
// self::$social['google']['auth_provider_x509_cert_url'] = 'https://www.googleapis.com/oauth2/v1/certs';
// self::$social['google']['client_secret']               = 'oo6LPHZXJA6JWkgPgPb7uJ0U';





if(!defined('shaparak_user'))
{
	define('shaparak_user', '926028');
}

if(!defined('shaparak_pass'))
{
	define('shaparak_pass', '123456');
}
?>