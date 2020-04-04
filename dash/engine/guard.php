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


	private static function header_xframe_option()
	{
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$enamad = 'https://trustseal.enamad.ir/';

			if(strpos($_SERVER['HTTP_REFERER'], $enamad) !== false)
			{
				@header('X-Frame-Options: *');
				return;
			}

		}
		@header('X-Frame-Options: DENY');
	}


	private static function header_content_security_policy()
	{
		$csp = '';
		// default src
		// $csp .= "default-src 'self'; ";
		$csp .= "default-src 'none'; ";
		// script-src
		// $csp .= "script-src ". self::csp_domain('cdn'). " *.google-analytics.com 'unsafe-inline'; ";
		$csp .= "script-src ". self::csp_domain('cdn'). " *.google-analytics.com static.cloudflareinsights.com; ";
		// style-src
		$csp .= "style-src ". self::csp_domain('cdn'). " 'unsafe-inline'; ";
		// $csp .= "style-src ". self::csp_domain('cdn'). "; ";
		// img-src
		$csp .= "img-src ". self::csp_domain(). " data:; ";
		// font-src
		$csp .= "font-src ". self::csp_domain('cdn'). "; ";
		// media-src
		$csp .= "media-src ". self::csp_domain(). " data:; ";
		// frame-src
		$csp .= "frame-src 'self'; ";
		// base-uri
		$csp .= "base-uri 'self'; ";
		// manifest-src
		$csp .= "manifest-src 'self'; ";
		// connect-src
		$csp .= "connect-src 'self' ". self::csp_domain('*', 'jibres'). "; ";
		// form-action
		$csp .= "form-action 'self'; ";

		// -------------------------------------- blocked
		// frame-ancestors
		$csp .= "frame-ancestors 'none'; ";
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


	private static function csp_domain($_subdomain = '*', $_domain = 'talambar')
	{
		$mine = 'https://'. $_subdomain. '.'. $_domain. '.com';

		if(\dash\url::tld() === 'local')
		{

			$mine = \dash\url::protocol(). '://'. $_subdomain. '.'. $_domain. '.local';
			$mine .= ' https://'. $_subdomain. '.'. $_domain. '.com';
		}
		elseif(\dash\url::tld() === 'ir')
		{
			$mine = 'https://'. $_subdomain. '.'. $_domain. '.ir';
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
			$updatePageUrl = root. 'public_html/static/page/lock/index.html';
			$updatePage = \dash\file::read($updatePageUrl);
			if($updatePage)
			{
				echo $updatePage;
				\dash\code::boom();
			}
			else
			{
				\dash\redirect::to(\dash\url::cdn(). '/page/lock/', true, 302);
			}
		}

	}
}
?>
