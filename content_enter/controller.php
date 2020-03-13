<?php
namespace content_enter;


class controller
{

	public static function routing()
	{
		self::check_login_as_referer();

		// all subdomain must be login to jibres
		// if(\dash\url::subdomain())
		// {
		// 	$query            = \dash\request::get();

		// 	if(!isset($query['referer']))
		// 	{
		// 		$query['referer'] = \dash\url::kingdom();
		// 	}

		// 	$query            = '?'. http_build_query($query);

		// 	$url = \dash\url::sitelang().'/enter'. $query;

		// 	\dash\redirect::to($url);
		// }


		// self::check_block_cookie();

		self::check_unlock_page();
		self::if_login_route();
		self::if_login_not_route();
		self::check_baned_user();

		// save referer
		// to redirect the user ofter login or signup on the referered address
		$referer = \dash\validate::url(\dash\request::get('referer'));
		if($referer)
		{
			$_SESSION['enter_referer'] = \dash\request::get('referer');
		}
	}

	public static function check_block_cookie()
	{
		if(empty($_SESSION) || !$_SESSION)
		{
			if(\dash\url::module() !== 'app')
			{
				\dash\notif::warn(T_("Your cookies may have been blocked"). ' '. T_("You need to enable cookie for usign this service"));
			}
			$_SESSION['check_cookie_is_blocked'] = true;
		}
	}


	public static function check_baned_user()
	{
		if(\dash\url::module() !== 'ban')
		{
			$ban = \dash\session::get('enter_baned_user');
			if($ban)
			{
				\dash\utility\enter::next_step('ban');
				\dash\notif::direct();
				\dash\utility\enter::go_to('ban');

			}
		}
	}

	private static function check_unlock_page()
	{
		$need_unlock =
		[
			'alert',
			'ban',
			'block',
			'byebye',
			'email',
			'okay',
			'pass',
			'pass/set',
			'pass/recovery',
			'pass/signup',
			'username',
			'verify',
			'verify/call',
			'verify/email',
			'verify/sendsms',
			'verify/telegram',
			'verify/sms',
			'verify/what',
		];

		$check_unlock = \dash\url::module();

		if(\dash\url::child())
		{
			$check_unlock .= '/'. \dash\url::child();
		}

		if(in_array($check_unlock, $need_unlock))
		{
			if(\dash\utility\enter::lock($check_unlock))
			{

				if($check_unlock === 'okay')
				{
					\dash\redirect::to(\dash\url::kingdom());
				}
				else
				{
					if(substr($check_unlock, 0,6) === 'verify')
					{
						if(\dash\user::id() && !\dash\user::detail('verifymobile'))
						{
							// no problem to load this page
						}
						else
						{
							\dash\header::status(403, $check_unlock);
						}
					}
					else
					{
						\dash\header::status(403, $check_unlock);
					}
				}
			}
		}
	}




	private static function if_login_route()
	{
		$if_login_route =
		[
			'delete',
		];

		$module = \dash\url::module();

		if(in_array($module, $if_login_route))
		{
			if(!\dash\user::login())
			{
				\dash\redirect::to(\dash\url::here());
			}
		}
	}


	private static function if_login_not_route()
	{
		$if_login_not_route_module =
		[
			'signup',
			'google',
		];

		$module = \dash\url::module();

		if(in_array($module, $if_login_not_route_module))
		{
			if(\dash\user::login())
			{
				\dash\redirect::to(\dash\url::site());
			}
		}
	}


	/**
	 * Login as a user to another store
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	private static function check_login_as_referer()
	{
		// this code only work on subdomain
		if(!\dash\url::subdomain())
		{
			return false;
		}

		// have referer
		if(!isset($_SERVER['HTTP_REFERER']))
		{
			return false;
		}
		// user must be login on master jibres domain
		if(!\dash\user::jibres_user())
		{
			return false;
		}

		// user must be not login on this subdomain
		if(\dash\user::id())
		{
			return false;
		}

		// we need host
		if(!isset($_SERVER['HTTP_HOST']))
		{
			return false;
		}

		$host = $_SERVER['HTTP_HOST'];


		$host_explode = explode('.', $host);

		// host must have subdomian.domain.tld
		if(count($host_explode) !== 3)
		{
			return false;
		}
		// domain must equal to host domain
		// need check when user connect her domain to jibres
		if($host_explode[1] !== \dash\url::root())
		{
			return false;
		}
		// tld must equal to host tld
		// need check when user connect her domain to jibres
		if($host_explode[2] !== \dash\url::tld())
		{
			return false;
		}

		// the referer subdomain
		$referer_subdomain = $host_explode[0];

		// @reza @check need to make validate subdomain function
		// $referer_subdomain = \dash\validate::subdomain($referer_subdomain);

		$referer = \dash\validate::url($_SERVER['HTTP_REFERER']);

		// the referer must compare the referer subdomain. for trust referer
		if(strpos($referer, $referer_subdomain) === false)
		{
			return false;
		}

		$keyMd5 = microtime(). '_'. \dash\user::jibres_user(). '_'. rand(). $referer_subdomain;
		$keyMd5 = md5($keyMd5);

		if(!isset($_SESSION['login_as']))
		{
			$_SESSION['login_as'] = [];
		}

		$_SESSION['login_as'][$referer_subdomain] =
		[
			'key'       => $keyMd5,
			'subdomain' => $referer_subdomain,
			'referer'   => $referer,
		];

		// all subdomain must be login to jibres

		$query            = \dash\request::get();

		if(!isset($query['referer']))
		{
			$query['referer'] = \dash\url::kingdom();
		}

		$query            = '?'. http_build_query($query);

		$url = \dash\url::sitelang().'/enter/loginas/'.$keyMd5. $query;

		\dash\redirect::to($url);

	}
}
?>