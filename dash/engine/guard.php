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
					// redirect to billboard
					\dash\redirect::to(\dash\url::kingdom(). '/billboard', 'billboard');
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
		$policy =
		[
			'default-src' =>
			[
				"'self'",
			],
			'script-src' =>
			[
				self::csp_cdn(),
				"www.google-analytics.com",
				"www.googletagmanager.com",
				"https://*.tawk.to",
				"https://cdn.jsdelivr.net/emojione/",
				"static.cloudflareinsights.com",
				"http://localhost:9759/jibres/",
			],
			'style-src' =>
			[
				self::csp_cdn(),
				"https:",
				"'unsafe-inline'",
			],
			'img-src' =>
			[
				self::csp_cdn(),
				self::csp_domain(),
				"https:",
				"blob:",
				"data:",
			],
			'font-src' =>
			[
				self::csp_cdn(),
				"https:",
				"data:",
			],
			'media-src' =>
			[
				self::csp_cdn(),
				self::csp_domain(),
				"data:",
			],
			'frame-src' =>
			[
				"'self'",
				"https://tejarak.com/",
				"https://status.jibres.com/",
				"https://sarshomar.com",
				"https://www.google.com/",
				"https://*.tawk.to",
				"https://www.youtube.com/",
				"https://www.aparat.com",
			],
			'base-uri' =>
			[
				"'self'",
			],
			'manifest-src' =>
			[
				"'self'",
			],
			'connect-src' =>
			[
				"'self'",
				'https://*.jibres.ir',
				'https://*.jibres.com',
				'wss:',
				'https:',
			],
			'form-action' =>
			[
				"'self'",
				'https://va.tawk.to'
			],
			'frame-ancestors' =>
			[
				"'self'",
				self::csp_domain('*', 'jibres'),
				\dash\url::site(),
				\dash\url::set_subdomain('*'),

			],
			'block-all-mixed-content' => [],

		];

		if(self::header_xframe_option(true))
		{
			// remove ancestors;
			unset($policy['frame-ancestors']);
		}

		if(\dash\url::module() === 'billboard')
		{
			// allow iframe on some conditions
			$policy['frame-ancestors'][] = 'https:';
		}


		// for local
		if(\dash\url::isLocal())
		{
			$policy['connect-src'][] = '*.jibres.local';
		}

		// create export txt
		$policyTxt = '';
		foreach ($policy as $group => $arr)
		{
			$policyTxt.= $group;
			foreach ($arr as $index => $val)
			{
				$policyTxt .= ' '. $val;
			}
			$policyTxt.= '; ';
		}

		$policyTxt = trim($policyTxt);

		// @todo add report
		// report-uri core.jibres.com/r10/csp/log

		@header("Content-Security-Policy: ". $policyTxt);
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
	// check customer domain origin
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

			$allow_origin    = false;
			$allow_method_all = false;

			if($last_char === '/' || $last_char === '.')
			{
				$allow_origin = true;
			}

			// allow bank payment
			if(strpos($origin, '.shaparak.ir') !== false)
			{
				$allow_origin = true;
			}

			// open some special origin
			$allow_origin_list =
			[
				'https://pay.ir',
			];

			if(in_array($origin, $allow_origin_list))
			{
				$allow_origin = true;
			}

			switch (\dash\url::subdomain())
			{
				case 'core':
				case 'api':
				case 'api':
				case 'business':
					$allow_origin     = true;
					$allow_method_all = true;
					break;

				default:
					break;
			}

			if($allow_origin)
			{
				// header('Access-Control-Allow-Origin: *', true);
				header('Access-Control-Allow-Origin: ' . $origin);

				// header('Access-Control-Allow-Headers: Accept,Authorization,Cache-Control,Content-Type,DNT,If-Modified-Since,Keep-Alive,Origin,User-Agent,X-Requested-With');
				header('Access-Control-Allow-Headers: Accept,Cache-Control,Content-Type,Keep-Alive,Origin,X-Requested-With');

				if($allow_method_all)
				{
					header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
				}
				else
				{
					header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
				}
			}
			else
			{
			\dash\engine\baby::pacifier(30);
			}
		}
	}

}
?>