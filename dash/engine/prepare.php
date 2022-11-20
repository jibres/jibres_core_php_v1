<?php
namespace dash\engine;


class prepare
{
	public static function requirements()
	{
		// set start engine power time
		\dash\engine\runtime::start_engine();

		\dash\engine\guard::hi_developers();
		self::minimum_requirement();

		self::error_handler();
		self::debug();

		// set shutdown fn
		self::dash_shutdown_function();
	}



	public static function basics()
	{
		self::debug(\dash\engine\error::debug_mode());

		// protect ourselve
		\dash\engine\guard::protect();

		// check need redirect for lang or www or https or main domain
		// self::fix_url_host();

		// self::check_domain();

		self::account_urls();

		// generate static files
		self::static_files();

		// self::user_country_redirect();

	}


	/**
	 * Prepare engine for user
	 */
	public static function user()
	{
		// set default timezone
		\dash\datetime::set_default_timezone();
	}


	/**
	 * Call before end code
	 */
	private static function dash_shutdown_function()
	{
		// 	register_shutdown_function(['\dash\utility\visitor', 'save']);
		// register_shutdown_function(['\dash\engine\runtime', 'shutdown']);
		register_shutdown_function(['\dash\waf\race', 'requestDone']);

		// close all scp connection
		register_shutdown_function(['\dash\scp', 'disconnect']);

		// close all mysql connection
		register_shutdown_function(['\dash\pdo\connection', 'close']);

		register_shutdown_function(['\dash\engine\prepare', 'engine_time']);
	}


	public static function engine_time()
	{
		if(!defined('ENGINE_START_TIME'))
		{
			return;
		}

		$start  = ENGINE_START_TIME;

		$now    = microtime(true);

		$diff   = $now - $start;

		$data   = json_encode(['diff' => $diff, /*'server' => \dash\server::get()*/]);

		$folder = 'engine_time';

		if(defined('ISCRONJOB') && ISCRONJOB)
		{
			// default cronjob mode
			if($diff > 120)
			{
				\dash\log::file($data, "engine_time_cronjob_critical.log", $folder);
			}

			return;
		}

		if($diff > 10)
		{
			\dash\log::file($data, "engine_time_critical.log", $folder);
		}
		elseif($diff > 5)
		{
			\dash\log::file($data, "engine_time_warn.log", $folder);
		}
		elseif($diff > 2)
		{
			\dash\log::file($data, "engine_time_check.log", $folder);
		}
	}


	/**
	* if the user use 'en' language of site
	* and her country is "IR"
	* and no referer to this page
	* and no cookie set from this site
	* redirect to 'fa' page
	* WARNING:
	* this function work when the default lanuage of site is 'en'
	* if the default language if 'fa'
	* and the user work by 'en' site
	* this function redirect to tj.com/fa/en
	* and then redirect to tj.com/en
	* so no change to user interface ;)
	*/
	private static function user_country_redirect()
	{
		if(\dash\url::content() !== null)
		{
			return;
		}

		$referer = \dash\server::referer() ? true : false;
		if($referer)
		{
			return false;
		}

		$cookie = \dash\utility\cookie::read('language');

		if(!$cookie && !\dash\url::lang())
		{
			$default_site_language = \dash\language::primary();

			$redirect_lang = 'en';
			$ipCountry     = null;

			if(\dash\server::get('HTTP_CF_IPCOUNTRY'))
			{
				$ipCountry = mb_strtoupper(\dash\server::get('HTTP_CF_IPCOUNTRY'));
			}
			elseif(\dash\server::get('HTTP_AR_REAL_COUNTRY'))
			{
				$ipCountry = mb_strtoupper(\dash\server::get('HTTP_AR_REAL_COUNTRY'));
			}
			else
			{
				return;
			}
			// force set ir to fa lang
			if(\dash\url::tld() === 'ir' || \dash\url::tld() === 'com')
			{
				$ipCountry = 'IR';
			}

			if($ipCountry === 'IR')
			{
				$redirect_lang = 'fa';
			}

			if(array_key_exists($redirect_lang, \dash\language::all()))
			{
				\dash\utility\cookie::write('language', $redirect_lang, (60*60*1));

				$my_url = \dash\url::base();

				if($default_site_language === $redirect_lang)
				{
					// nothing
				}
				else
				{
					$my_url .= '/'. $redirect_lang;
				}

				if(\dash\url::path() !== '/')
				{
					$my_url .= \dash\url::path();
				}

				\dash\redirect::to($my_url);
			}
		}
	}



	/**
	 * [account_urls description]
	 * @return [type] [description]
	 */
	private static function account_urls()
	{
		$param = \dash\url::query();
		if($param)
		{
			$param = '?'.$param;
		}

		$myrep = \dash\url::content();
		switch (\dash\url::module())
		{
			case 'signin':
			case 'login':
				$url = \dash\url::kingdom(). '/enter'. $param;
				\dash\redirect::to($url, true, 308);
				break;

			case 'signup':
				if($myrep !== 'enter')
				{
					$url = \dash\url::kingdom(). '/enter/signup'. $param;
					\dash\redirect::to($url, true, 308);
				}
				break;

			case 'register':

				$url = \dash\url::kingdom(). '/enter/signup'. $param;
				\dash\redirect::to($url, true, 308);
				break;

			case 'signout':
			case 'logout':
				if($myrep !== 'enter')
				{
					$url = \dash\url::kingdom(). '/enter/logout'. $param;
					\dash\redirect::to($url, true, 308);
				}

				break;
		}

		switch (\dash\url::directory())
		{
			case 'account/recovery':
			case 'account/changepass':
			case 'account/verification':
			case 'account/verificationsms':
			case 'account/signin':
			case 'account/login':
				$url = \dash\url::kingdom(). '/enter'. $param;
				\dash\redirect::to($url, true, 308);
				break;

			case 'account/signup':
			case 'account/register':
				$url = \dash\url::kingdom(). '/enter/signup'. $param;
				\dash\redirect::to($url, true, 308);
				break;

			case 'account/logout':
			case 'account/signout':
				$url = \dash\url::kingdom(). '/enter/logout'. $param;
				\dash\redirect::to($url, true, 308);
				break;
		}
	}

	/**
	 * generate some static files automatically
	 * @return [type] [description]
	 */
	private static function static_files()
	{

		switch (\dash\url::directory())
		{
			case 'sitemap.xml':
				\dash\utility\sitemap::sitemap();
				break;

			case 'manifest.webmanifest':
				\dash\engine\pwa::manifest();
				break;

			case 'serviceWorker':
			case 'serviceWorker/v2':
			case 'serviceWorker/v3':
			case 'serviceWorker-v3':
				\dash\engine\pwa::service_worker();
				break;

			case 'offline.html':
				\dash\engine\pwa::offline();
				break;

			case 'robots.txt':
				\dash\engine\static_files::robots();
				break;

			case 'browserconfig.xml':
				\dash\engine\static_files::browserconfig_xml();
				break;

			case 'static/humans.txt':
			case 'humans.txt':
			case 'contributors':
				\dash\engine\static_files::human();
				break;
		}
	}


	/**
	 * set best domain and url
	 * @return [type] [description]
	 */
	public static function hsts()
	{
		// decalare target url
		$target_host = '';

		// // fix protocol
		// if(\dash\url::isLocal())
		// {
		// 	$target_host = \dash\url::protocol().'://';
		// }
		// else
		// {

		// }
		$target_host = 'https://';

		if(\dash\url::subdomain() && \dash\url::subdomain() !== 'www')
		{
			$target_host .= \dash\url::subdomain(). '.';
		}

		if(\dash\url::root())
		{
			$target_host .= \dash\url::root();
		}

		if(\dash\url::tld())
		{
			if(\dash\url::tld() === 'local')
			{
				// local is exception
				$target_host .= '.'.\dash\url::tld();
			}
			elseif(in_array(\dash\url::tld(), ['icu', 'xyz', 'store', 'club', 'me']) && \dash\url::root() === 'jibres')
			{
				// icu and xyz is exception
				$target_host .= '.'.\dash\url::tld();
			}
			elseif(\dash\language::current() === 'fa' && \dash\url::root() === 'jibres')
			{
				// disallow open fa in another tld
				$target_host .= '.ir';
			}
			elseif(\dash\language::current() === 'en' && \dash\url::root() === 'jibres')
			{
				// disallow open en in another tld
				$target_host .= '.com';
			}
			else
			{
				$target_host .= '.'.\dash\url::tld();
			}
		}

		if(\dash\url::port() && \dash\url::port() !== 80 && \dash\url::port() !== 443)
		{
			$target_host .= ':'.\dash\url::port();
		}

		if(\dash\url::related_url())
		{
			$target_host .= \dash\url::related_url();
		}

		$target_url = $target_host;
		$myContent  = \dash\url::content();
		if($myContent === 'hook' || $myContent === 'api' || $myContent === 'core')
		{
			$target_url .= \dash\url::path();
		}
		else if(\dash\url::lang() === \dash\language::primary())
		{
			// try to remove lang from url
			if(\dash\url::content())
			{
				$target_url .= '/'. \dash\url::content();
			}
			if(\dash\url::directory())
			{
				$target_url .= '/'. \dash\url::directory();
			}

			// set cookie of language to fix false detection after redirect
			\dash\utility\cookie::write('language', \dash\url::lang(), (60*60*1));
		}
		else
		{
			$target_url .= \dash\url::path();
		}
		// set target url with path
		$target_url = self::fix_url_slash($target_url);

		$full_target = $target_url;

		// if(\dash\url::query())
		// {
		// 	$query_string = \dash\url::query();

		// 	if(substr($query_string, -1) === '/')
		// 	{
		// 		$query_string = substr($query_string, 0, (mb_strlen($query_string) - 1));
		// 	}

		// 	$full_target .= '?'. $query_string;
		// }

		if(\dash\str::strpos($full_target, '?') === false && \dash\request::get())
		{
			$full_target .= '?'. \dash\url::query();
		}

		if($target_host === \dash\url::base())
		{
			// only check last slash
			if($target_url !== \dash\url::pwd())
			{
				\dash\redirect::to($full_target, true, 301);
			}
		}
		else
		{
			// change host and slash together
			\dash\redirect::to($full_target, true, 301);
		}

	}


	/**
	 * fix slash, if needed add it else remove it
	 * @param  [type] $_url [description]
	 * @return [type]       [description]
	 */
	private static function fix_url_slash($_url)
	{
		$myBrowser = \dash\utility\browserDetection::browser_detection('browser_name');
		if($myBrowser === 'samsungbrowser')
		{
			// samsung is stupid!
		}
		else
		{
			// remove slash in normal condition
			$_url = trim($_url, '/');

			if(\dash\url::path() === '/')
			{
				// add slash for homepage
				$_url .= '/';
			}
		}
		return $_url;
	}




	/**
	 * set custom error handler
	 */
	private static function error_handler()
	{
		//Setting for the PHP Error Handler
		set_error_handler( "\\dash\\engine\\error::handle_error" );

		//Setting for the PHP Exceptions Error Handler
		set_exception_handler( "\\dash\\engine\\error::handle_exception" );

		//Setting for the PHP Fatal Error
		register_shutdown_function( "\\dash\\engine\\error::handle_fatal" );
	}


	/**
	 * set debug status
	 * @param  [type] $_status [description]
	 */
	public static function debug($_status = null)
	{
		if($_status)
		{
			ini_set('display_startup_errors', 'On');
			ini_set('error_reporting'       , 'E_ALL | E_STRICT');
			ini_set('track_errors'          , 'On');
			ini_set('display_errors'        , 1);
			error_reporting(E_ALL);
		}
		else
		{
			error_reporting(0);
			ini_set('display_errors', 0);
		}
	}


	/**
	 * check current version of server technologies like php and mysql
	 * and if is less than min, show error message
	 * @return [type] [description]
	 */
	private static function minimum_requirement()
	{
		// check php version to upper than 7.0
		if(version_compare(phpversion(), '7.1', '<'))
		{
			\dash\code::bye("<p>For using Dash you must update php version to 7.1 or higher!</p>");
		}
	}


	/**
	 * check customer domain
	 * if domain != jibres check cookie to load it
	 * for social robots
	 */
	public static function check_domain()
	{
		// free subdomain like api.jibres.com, business.jibres.ir, ...
		if(\dash\engine\store::free_subdomain())
		{
			return false;
		}

		$specail_my_business_domain =
		[
			'blog.jibres.ir',
			'blog.jibres.com',
			'help.jibres.ir',
			'help.jibres.com',
			'blog.jibres.local',
			'help.jibres.local',
		];

		if(in_array(\dash\url::host(), $specail_my_business_domain))
		{
			// need to check business domain
			$is_customer_domain = \dash\engine\store::is_customer_domain(\dash\url::host());

			if($is_customer_domain)
			{
				return;
			}
		}

		$domain    = \dash\url::domain();
		$subdomain = \dash\url::subdomain();

		if($subdomain)
		{
			switch ($domain)
			{
				// case 'myjibres.ir':
				// 	self::go_to_jibres();
				// 	return;
				// 	break;

				case 'jibres.me':
				// case 'myjibres.com':
				case 'myjibres.local':
					// nothing
					return;
					break;

				case 'myjibres.ir':
				case 'jibres.store':
				case 'jibres.ir':
				case 'jibres.com':
				case 'jibres.local':
					self::go_to_business_domain();
					return;
					break;
			}
		}
		else
		{
			switch ($domain)
			{
				case 'jibres.ir':
				case 'jibres.com':
				case 'jibres.local':
					// nothing
					return;
					break;

				case 'jibres.store':
				case 'jibres.me':
				case 'myjibres.ir':
				// case 'myjibres.com':
				case 'myjibres.local':
					self::go_to_jibres();
					return;
					break;
			}
		}

		// check is customer domain or no
		$is_customer_domain = \dash\engine\store::is_customer_domain(\dash\url::host());

		if($is_customer_domain)
		{
			return;
		}

		// our domains
		switch ($domain)
		{
			case 'g2j.ir':
			case '2jr.ir':
			case 'jeebres.ir':
				\dash\redirect::to('https://jibres.ir');
				break;

			case 'jeebres.com':
				\dash\redirect::to('https://jibres.com');
				break;
		}

		// emergency domain
		$emergency_domain =
		[

			'jibres.xyz',
			'jibres.icu',
			'jb8.ir',
			'jb5.ir',
			// 'jibres.me',
		];

		if(in_array($domain, $emergency_domain))
		{
			$is_bot = false;
			if($is_bot)
			{
				self::html_raw_page('botMode');
			}
			else
			{
				$cookie = \dash\utility\cookie::read('emergencydomain');
				if($cookie)
				{
					return;
				}

				// route static files
				self::static_files();

				if(\dash\request::post('emergencydomain') === 'emergencydomain')
				{
					\dash\utility\cookie::write('emergencydomain', 'ok');
					\dash\redirect::pwd();
					return true;
				}

				self::html_raw_page('emergencyMode');
			}
		}

		// transfer club to campaign
		if($domain === 'jibres.club')
		{
			$target = 'https://jibres.ir/campaign';
			if(\dash\url::query())
			{
				$target .= '?'.\dash\url::query();
			}
			\dash\redirect::to($target);
		}

		// need check if domain in my list
		$is_customer_domain_cache_file = \dash\engine\store::is_customer_domain_cache_file(\dash\url::host());
		if($is_customer_domain_cache_file)
		{
			self::html_raw_page('customeDomainCacheFile');
		}
		else
		{
			\dash\header::set(404);
			self::html_raw_page('unknownMode');
		}
	}


	private static function go_to_jibres()
	{
		$url = \dash\url::protocol(). '://jibres.';
		switch (\dash\url::tld())
		{
			case 'com':
			case 'local':
				$url .= \dash\url::tld();
				break;

			case 'store':
			case 'me':
			default:
				$url .= 'ir';
				break;
		}

		\dash\redirect::to($url);
	}



	private static function go_to_business_domain()
	{
		$url = \dash\url::protocol(). '://';
		$url .= \dash\url::subdomain();
		switch (\dash\url::tld())
		{
			case 'local':
				$url .= '.myjibres.'. \dash\url::tld();
				break;

			case 'com':
			case 'ir':
			default:
				// $url .= '.jibres.store';
				$url .= '.'. \dash\engine\store::active_domain_for_business();
				break;
		}
		if(\dash\url::path())
		{
			$url .= \dash\url::path();
		}
		\dash\redirect::to($url, true, 301);
	}


	public static function html_raw_page($_file_name)
	{
		$emergencydomain = core. 'layout/html/'.$_file_name.'.html';

		if(!is_file($emergencydomain))
		{
			$emergencydomain = core. 'layout/html/'.$_file_name.'.php';
		}

		require_once ($emergencydomain);

		\dash\code::boom();
	}
}
?>