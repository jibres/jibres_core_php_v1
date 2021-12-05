<?php
namespace content_enter;


class controller
{

	public static function routing()
	{
		$wafLimit = \dash\waf\ip::isLimit();

		if($wafLimit)
		{
			if(\dash\url::module() !== 'block')
			{
				\dash\utility\enter::next_step('block');
				\dash\utility\enter::go_to('block');
			}
		}

		// all subdomain must be login to jibres
		if(\dash\url::store())
		{
			$query = \dash\request::get();

			// if(!isset($query['referer']))
			// {
			// 	$query['referer'] = \dash\url::kingdom();
			// }
			if($query)
			{
				$query = '?'. http_build_query($query);
			}
			else
			{
				$query = '';
			}

			$url = \dash\url::sitelang().'/enter'. $query;

			\dash\redirect::to($url);
		}



		self::check_disallow_business_enter();


		self::check_unlock_page();
		self::if_login_route();
		self::if_login_not_route();
		self::check_baned_user();

		// save referer
		// to redirect the user ofter login or signup on the referered address
		$ref = \dash\request::get('referer');

		if(!is_null($ref))
		{
			$refDecode = \dash\str::urldecode(\dash\str::urldecode(\dash\str::urldecode($ref)));
			if(\dash\str::strpos($refDecode, '://') !== false)
			{
				// have a link to another location
				// open redirect bug
				\dash\header::status(451);
			}
		}

		// @todo
		// need validate relative url
		//
		// $referer = \dash\validate::url($ref, false);
		// if($referer)
		// {
		// }
		if($ref)
		{
			\dash\session::set('enter_referer', $ref);
		}
	}


	private static function check_disallow_business_enter()
	{
		if(!\dash\engine\store::inStore())
		{
			return;
		}

		if(\lib\store::detail('enterdisallow'))
		{
			\dash\redirect::to(\dash\url::kingdom());
		}
	}

	public static function check_disallow_business_enter_signup($_redirect = false)
	{
		if(!\dash\engine\store::inStore())
		{
			return false;
		}

		if(\lib\store::detail('entersignupdisallow'))
		{
			if($_redirect)
			{
				\dash\redirect::to(\dash\url::kingdom());
			}
			else
			{
				return true;
			}
		}

		return false;
	}



	public static function check_baned_user()
	{
		if(\dash\url::module() !== 'ban' && \dash\url::module() !== 'block')
		{
			$ban = \dash\session::get('enter_baned_user');
			if($ban)
			{
				\dash\utility\enter::next_step('ban');
				\dash\notif::direct();
				\dash\utility\enter::go_to('ban');

			}

			\dash\utility\enter::check_user_ban();
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
							// \dash\header::status(403, $check_unlock);
							\dash\redirect::to(\dash\url::here());
						}
					}
					else
					{
						// \dash\header::status(403, $check_unlock);
						\dash\redirect::to(\dash\url::here());
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
			// 'google',
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


}
?>