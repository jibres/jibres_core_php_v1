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
		// self::header_feature_policy();
		self::header_XSS_Protection();
		self::header_Content_Type_Options();
		self::header_permissions_policy();
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
		@header("Server: Jibres");
		@header("X-Powered-By: Jibres");
		$server_code_name = \dash\engine\fuel::server_code_name(\dash\server::server_ip());
		@header("X-Node: ". $server_code_name);
	}


	private static function header_xframe_option($_readonly = null)
	{
		$referer = \dash\server::referer();
		if($referer)
		{
			$enamad = 'https://trustseal.enamad.ir/';

			$allow_domain =
			[
				'https://jibres.ir',
				'https://jibres.ir/',

				'https://jibres.com',
				'https://jibres.com/',

				'https://jibres.local',
				'https://jibres.local/',

				'http://jibres.local',
				'http://jibres.local/',
			];

			if(in_array($referer, $allow_domain))
			{
				if(!$_readonly)
				{
					@header("X-frame: Jibres");
				}

				return true;
			}
			elseif(strpos($referer, $enamad) !== false)
			{
				if(!$_readonly)
				{
					@header("X-frame: Enamad");

					// redirect to billboard
					// @header('X-Frame-Options: *');

					// below line is not supported in browsers yet
					// @header('X-Frame-Options: allow-from '. $enamad);

					// \dash\redirect::to(\dash\url::kingdom(). '/billboard', 'billboard');
				}
				return true;
			}

			// if(strpos($referer, '.local/') !== false)
			// {
			// 	if(!$_readonly)
			// 	{
			// 		// @header('X-Frame-Options: allow-from '. $referer);
			// 	}
			// 	return true;
			// }
		}
		if(!$_readonly)
		{
			if(\dash\url::module() === 'billboard')
			{
				// allow
				// @header('X-Frame-Options: *');
			}
			else
			{
				@header('X-Frame-Options: DENY');
			}
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
				"https:",
				"blob:",
				"data:",
			],
			'media-src' =>
			[
				"https:",
				"blob:",
				"data:",
			],
			'font-src' =>
			[
				"https:",
				"data:",
			],
			'frame-src' =>
			[
				"'self'",
				"https:",
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
			],
			'frame-ancestors' =>
			[
				"'self'",
				\dash\url::site(),
				self::csp_domain('*', 'jibres'),
			],
			'block-all-mixed-content' => [],
		];

		if(self::header_xframe_option(true) || \dash\url::module() === 'billboard')
		{
			// remove ancestors;
			unset($policy['frame-ancestors']);
		}

		if(\dash\url::module() === 'billboard')
		{
			// allow iframe on some conditions
			$policy['frame-ancestors'] = ['https:'];
		}

		// add some special if that one exist on page
		// google analytics
		if(\dash\captcha\recaptcha::sitekey())
		{
			$policy['script-src'][] = "https://www.google.com/";
			$policy['script-src'][] = "https://www.gstatic.com/";
		}
		// google analytics
		if(\dash\engine\viewThirdParty::googleAnalytics())
		{
			$policy['script-src'][] = "www.google-analytics.com";
			$policy['script-src'][] = "www.googletagmanager.com";
		}
		// tawk
		if(\dash\engine\viewThirdParty::tawk())
		{
			$policy['script-src'][] = "https://*.tawk.to";
			$policy['script-src'][] = "https://cdn.jsdelivr.net/emojione/";
			$policy['script-src'][] = "static.cloudflareinsights.com";
			$policy['form-action'][] = 'https://va.tawk.to';
		}
		// Raychat
		if(\dash\engine\viewThirdParty::raychat())
		{
			$policy['script-src'][] = "https://*.raychat.io/";
			// $policy['script-src'][] = "'unsafe-inline'";
			$policy['media-src'][] = "https://app.raychat.io/";
		}
		// Imber
		if(\dash\engine\viewThirdParty::imber())
		{
			$policy['script-src'][] = "https://*.imber.live/";
		}
		// mediaadd
		if(\dash\engine\viewThirdParty::mediaad())
		{
			$policy['script-src'][] = "https://s1.mediaad.org/";
		}

		// enable blob worker for code editor
		// disable worker for editor
		// if(\dash\url::directory() === 'section/html')
		// {
		// 	// $policy['worker-src'][] = "'self'";
		// 	$policy['worker-src'][] = "blob:";
		// }

		// for local
		if(\dash\url::isLocal())
		{
			$policy['connect-src'][] = '*.jibres.local';
			$policy['img-src'][] = '*.jibres.local';
			$policy['img-src'][] = '*.myjibres.local';
			$policy['font-src'][] = '*.jibres.local';
			$policy['frame-src'][] = 'http:';
			$policy['media-src'][] = "*.jibres.local";
			$policy['frame-ancestors'][] = 'http:';
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


	private static function header_XSS_Protection()
	{
		// The HTTP X-XSS-Protection response header is a feature of Internet Explorer, Chrome and Safari
		// that stops pages from loading when they detect reflected cross-site scripting (XSS) attacks.
		// Although these protections are largely unnecessary in modern browsers
		// when sites implement a strong Content-Security-Policy that disables
		// the use of inline JavaScript ('unsafe-inline'),
		// they can still provide protections for users of older web browsers that don't yet support CSP.

		@header('X-XSS-Protection: 1; mode=block');
	}


	private static function header_Content_Type_Options()
	{
		// The X-Content-Type-Options response HTTP header is a marker used by the server
		// to indicate that the MIME types advertised in the Content-Type headers should not be changed and be followed.
		// This is a way to opt out of MIME type sniffing, or, in other words, to say that the MIME types are deliberately configured.

		@header('X-Content-Type-Options: nosniff');
	}


	private static function header_feature_policy()
	{
		@header("Feature-Policy: accelerometer 'none'; camera 'none'; geolocation 'none'; gyroscope 'none'; magnetometer 'none'; microphone 'none'; payment 'none'; usb 'none'");
	}


	private static function header_permissions_policy()
	{
		@header("Permissions-Policy: fullscreen=(), geolocation=()");
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
		if(\dash\url::content() === 'sudo')
		{
			return;
		}
		// route force unlock page
		if(\dash\url::directory() === 'forceunlock')
		{
			return;
		}

		// set header processing ...
		// say te search engines to retry after 30 seconds
		@header("Retry-After: 30");
		\dash\header::set(503);

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
			require_once (core. 'layout/html/lockMode.php');
			\dash\code::boom();
		}
	}


	// @TODO
	// check customer domain origin
	public static function origin()
	{
		if (\dash\server::get('HTTP_ORIGIN'))
		{
			$origin = \dash\server::get('HTTP_ORIGIN');

			if(!\dash\url::jibreLocal())
			{
				if(substr($origin, 0, 8) !== 'https://')
				{
					\dash\header::status(418, 'origin 1');
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
				'https://idpay.ir',
			];

			if(in_array($origin, $allow_origin_list))
			{
				$allow_origin = true;
			}

			switch (\dash\url::subdomain())
			{
				case 'core':
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
				\dash\header::status(418, 'origin 2');
			}
		}
	}

}
?>