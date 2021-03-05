<?php
namespace content_v2\account\enter;


class model
{


	private static $life_time      = 60 * 2;
	private static $verifycode     = null;
	private static $mobile         = null;
	private static $user_id        = null;
	private static $mobile_user_id = null;
	private static $response       = null;


	public static function post()
	{
		\content_v2\tools::check_token();

		\content_v2\tools::apikey_required();

		$subchild = \dash\url::dir(4);

		self::login();


		if(!\dash\engine\process::status())
		{
			\dash\header::set(400);
		}

		\content_v2\tools::say(self::$response);

	}

	private static function login()
	{
		$check_input = self::check_input();
		if(!$check_input)
		{
			return false;
		}

		$user_id = \dash\app\user::quick_add(['mobile' => self::$mobile]);
		if(!$user_id)
		{
			\dash\log::set('API-canNotSignupUserEnter');
			\dash\notif::error(T_("Can not signup this mobile"));
			return false;
		}

		self::$mobile_user_id = $user_id;

		$check_log =
		[
			'caller' => 'enter_apiverificationcode',
			'to'     => $user_id,
			'limit'  => 1,
		];

		$check_log = \dash\db\logs::get($check_log, ['order' => 'ORDER BY logs.id DESC']);

		$generate_new_code = false;

		if(!isset($check_log['id']))
		{
			$generate_new_code = true;
		}
		else
		{
			// 'enable','disable','expire','deliver','awaiting','deleted','cancel','block','notif','notifread','notifexpire'
			if(isset($check_log['status']) && in_array($check_log['status'], ['enable', 'notif', 'notifread']))
			{
				if(isset($check_log['datecreated']))
				{
					$old_time = strtotime($check_log['datecreated']);
					if((time() - $old_time) > self::$life_time)
					{
						$generate_new_code = true;
					}
				}
				else
				{
					$generate_new_code = true;
				}
			}
			else
			{
				$generate_new_code = true;
			}
		}


		if($generate_new_code)
		{
			$myCode = rand(10000, 99999);
			// $myCode = 12345;

			$log =
			[
				'to'     => $user_id,
				'code'   => $myCode,
				'mycode' => $myCode,
			];

			\dash\log::set('enter_apiverificationcode', $log);
			\dash\notif::ok(T_("The verification code sended to phone number"));
			return true;
		}
		else
		{
			\dash\notif::error(T_("A verification code was sended to user before"));
			return false;
		}
	}


	private static function check_input()
	{
		$mobile = \content_v2\tools::input_body('mobile');
		if(!$mobile)
		{
			\dash\notif::error(T_("Mobile not set"), 'mobile');
			return false;
		}

		$mobile = \dash\validate::mobile($mobile, false);
		if(!$mobile)
		{
			\dash\notif::error(T_("Invalid mobile"), 'mobile');
			return false;
		}

		$verifycode = \content_v2\tools::input_body('verifycode');
		if($verifycode)
		{
			if(!is_numeric($verifycode))
			{
				\dash\notif::error(T_("Invalid verifycode"), 'verifycode');
				return false;
			}

			$verifycode = intval($verifycode);

			if($verifycode < 10000 || $verifycode > 99999)
			{
				\dash\notif::error(T_("Verification code is out of range"), 'verifycode');
				return false;
			}
		}

		self::$mobile     = $mobile;
		self::$verifycode = $verifycode;

		return true;
	}

}
?>