<?php
namespace dash\engine;
/**
 * dash main configure
 */
class guard
{
	public static function protect()
	{
		self::header_xframe_option();
		self::header_content_security_policy();
		self::header_referrer_policy();
		self::header_feature_policy();
		// self::header_expect_ct();
		// check server lock status
		self::server_lock();
	}


	/**
	 * set some header and say hi to developers
	 */
	public static function hi_developers()
	{
		// change header and remove php from it
		@header("X-Powered-By: Jibres");
		$server_code_name = \dash\engine\fuel::server_code_name(\dash\server::server_ip());
		@header("X-Node: ". $server_code_name);

	}


	private static function header_xframe_option($_readonly = null)
	{
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$enamad = 'https://trustseal.enamad.ir/';

			if(strpos($_SERVER['HTTP_REFERER'], $enamad) !== false)
			{
				if(!$_readonly)
				{
					// @header('X-Frame-Options: *');
				}
				return true;
			}
			if(strpos($_SERVER['HTTP_REFERER'], '.local/') !== false)
			{
				if(!$_readonly)
				{
					@header('X-Frame-Options: *');
				}
				return true;
			}
		}
		if(!$_readonly)
		{
			@header('X-Frame-Options: DENY');
		}
		return false;
	}


	private static function header_content_security_policy()
	{
		$csp = '';
		// default src
		// $csp .= "default-src 'self'; ";
		$csp .= "default-src 'none'; ";
		// script-src
		// $csp .= "script-src ". self::csp_cdn(). " www.google-analytics.com 'unsafe-inline'; ";
		$csp .= "script-src ". self::csp_cdn(). " www.google-analytics.com www.googletagmanager.com static.cloudflareinsights.com http://localhost:9759/jibres/; ";
		// style-src
		$csp .= "style-src ". self::csp_cdn(). " 'unsafe-inline'; ";
		// $csp .= "style-src ". self::csp_cdn(). "; ";
		// img-src
		$csp .= "img-src ". self::csp_cdn(). ' '. self::csp_domain(). " https: blob: data:; ";
		// font-src
		$csp .= "font-src ". self::csp_cdn(). " data:; ";
		// media-src
		$csp .= "media-src ". self::csp_cdn(). ' '. self::csp_domain(). " data:; ";
		// frame-src
		$csp .= "frame-src 'self' https://tejarak.com/ https://status.jibres.com/ https://sarshomar.com https://www.google.com/; ";
		// base-uri
		$csp .= "base-uri 'self'; ";
		// manifest-src
		$csp .= "manifest-src 'self'; ";
		// connect-src
		$csp .= "connect-src 'self' ". self::csp_cdn(). ' '. self::csp_domain('cloud'). ' '. self::csp_domain('*', 'jibres'). " ". self::csp_domain(false, 'jibres'). "; ";
		// form-action
		$csp .= "form-action 'self'; ";

		// -------------------------------------- blocked
		// frame-ancestors
		if(!self::header_xframe_option(true))
		{
			// allow iframe on some conditions
			if(\dash\url::module() === 'billboard')
			{
				$csp .= "frame-ancestors https:; ";
			}
			else
			{
				$csp .= "frame-ancestors self ". self::csp_domain('*', 'jibres'). " ". \dash\url::site(). "; ";
				// $csp .= "frame-ancestors 'none'; ";
			}
		}
		// block all mixed content
		$csp .= "block-all-mixed-content;";

		// @todo add report
		// report-uri core.jibres.com/r10/csp/log

		@header("Content-Security-Policy: ". $csp);
	}


	private static function header_referrer_policy()
	{
		// origin-when-cross-origin
		// The browser will send the full URL to requests to the same origin
		// but only send the origin when requests are cross-origin.

		// strict-origin-when-cross-origin
		// Similar to origin-when-cross-origin above
		// but will not allow any information to be sent
		// when a scheme downgrade happens (the user is navigating from HTTPS to HTTP).

		@header("Referrer-Policy: strict-origin-when-cross-origin");
	}


	private static function header_feature_policy()
	{
		@header("Feature-Policy: accelerometer 'none'; camera 'none'; geolocation 'none'; gyroscope 'none'; magnetometer 'none'; microphone 'none'; payment 'none'; usb 'none'");
	}


	private static function header_expect_ct()
	{
		if(\dash\url::protocol() === 'https')
		{
			// @header("Expect-CT : max-age=0;");
		}
	}

	private static function csp_cdn()
	{
		$url = \dash\url::protocol(). '://cdn.jibres.';


		// todo @Reza fix after load store
		$url .= 'ir';
		$url .= ' '. \dash\url::protocol(). '://cdn.jibres.com';

		// todo @Reza fix after load store
		// if(\dash\url::tld() === 'ir')
		// {
		// 	$url .= 'ir';
		// 	$url .= ' '. \dash\url::protocol(). '://cdn.jibres.com';
		// }
		// else
		// {
		// 	$url .= 'com';
		// }

		if(\dash\url::tld() === 'local')
		{
			$url .= ' '. \dash\url::protocol(). '://cdn.jibres.local';
		}

		return $url;
	}


	private static function csp_domain($_subdomain = '*', $_domain = 'talambar')
	{
		// $mine = 'https://'. $_subdomain. '.'. $_domain. '.com';
		$mine = 'https://'. $_subdomain. '.'. $_domain. '.com';
		if($_subdomain === false)
		{
			$mine = 'https://'. $_domain. '.com';
		}

		if(\dash\url::tld() === 'local')
		{
			if($_subdomain === false)
			{
				$mine .= ' '. \dash\url::protocol(). '://'. $_domain. '.local';
			}
			else
			{
				$mine .= ' '. \dash\url::protocol(). '://'. $_subdomain. '.'. $_domain. '.local';
			}
		}
		elseif(\dash\url::tld() === 'ir')
		{
			if($_subdomain === false)
			{
				$mine .= ' https://'. $_domain. '.ir';
			}
			else
			{
				$mine .= ' https://'. $_subdomain. '.'. $_domain. '.ir';
			}
		}

		return $mine;
	}


	private static function server_lock()
	{
		$lock = \dash\engine\lock::is();

		if(!$lock)
		{
			return;
		}

		// in lock mode su can be load
		if(\dash\url::content() === 'su')
		{
			return;
		}
		// route force unlock page
		if(\dash\url::directory() === 'forceunlock')
		{
			return;
		}

		// set header processing ...
		\dash\header::set(202);

		if(\dash\request::ajax())
		{
			$msg = T_("Please wait a moment, The system is being updated ...");

			// in smile request we not show notif
			if(\dash\url::content() === 'hook' && \dash\url::module() === 'smile')
			{
				\dash\notif::result($msg);
			}
			else
			{
				\dash\notif::info($msg);
			}

			\dash\code::end();
		}
		else
		{
			require_once (core. 'layout/html/lockMode.html');
			\dash\code::boom();
		}
	}


	// @TODO
	// check customer domain origine
	public static function origin()
	{
		if (isset($_SERVER['HTTP_ORIGIN']))
		{
	    	$origin = $_SERVER['HTTP_ORIGIN'];

	    	if(!\dash\url::jibreLocal())
	    	{
		    	if(substr($origin, 0, 8) !== 'https://')
		    	{
					\dash\engine\baby::pacifier(25);
		    	}
	    	}

	    	if($origin === \dash\url::base())
	    	{
	    		return;
	    	}

			$domain    = \dash\url::domain();
			$myOrigin  = str_replace($domain, '', $origin);
			$last_char = substr($myOrigin, -1);

	    	$allow_origine = false;

	    	if($last_char === '/' || $last_char === '.')
	    	{
	    		$allow_origine = true;
	    	}

	    	// allow bank payment
	    	if(strpos($origin, '.shaparak.ir') !== false)
	    	{
	    		$allow_origine = true;
	    	}

	    	// open some special origine
	    	$allow_origine_list =
	    	[
	    		'https://pay.ir',
	    	];

	    	if(in_array($origin, $allow_origine_list))
	    	{
	    		$allow_origine = true;
	    	}

	    	if($allow_origine)
	    	{
	    	    // header('Access-Control-Allow-Origin: *', true);
			    header('Access-Control-Allow-Origin: ' . $origin);

				// header('Access-Control-Allow-Headers: Accept,Authorization,Cache-Control,Content-Type,DNT,If-Modified-Since,Keep-Alive,Origin,User-Agent,X-Requested-With');
				header('Access-Control-Allow-Headers: Accept,Cache-Control,Content-Type,Keep-Alive,Origin,X-Requested-With');

				// header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
				header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

	    	}
	    	else
	    	{
				\dash\engine\baby::pacifier(30);
	    	}
    	}
	}

}
?>
