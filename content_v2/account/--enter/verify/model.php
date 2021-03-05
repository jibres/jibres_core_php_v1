<?php
namespace content_v2\account\enter\verify;


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

		self::verify();

		if(!\dash\engine\process::status())
		{
			\dash\header::set(400);
		}

		\content_v2\tools::say(self::$response);

	}


	private static function check_input()
	{
		$mobile = \content_v2\tools::input_body('mobile');
		if(!$mobile)
		{
			\dash\notif::error(T_("Mobile not set"), 'mobile');
			return false;
		}

		$mobile = \dash\validate::mobile($mobile);
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


	private static function verify()
	{
		$check_input = self::check_input();
		if(!$check_input)
		{
			return false;
		}

		if(!self::$verifycode)
		{
			\dash\notif::error(T_("Verification code not set"), 'verifycode');
			return false;
		}

		$user_id = \dash\app\user::quick_add(['mobile' => self::$mobile]);
		if(!$user_id)
		{
			\dash\log::set('API-canNotSignupUserEnterVerify');
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
			\dash\notif::error(T_("No verifycation code sended to this phone number"));
			return false;
		}
		else
		{
			if(isset($check_log['status']) && in_array($check_log['status'], ['enable', 'notif', 'notifread']))
			{
				if(isset($check_log['datecreated']))
				{
					$old_time = strtotime($check_log['datecreated']);
					if((time() - $old_time) < self::$life_time)
					{
						if(isset($check_log['code']))
						{
							if(intval($check_log['code']) === intval(self::$verifycode))
							{
								\dash\db\logs::update(['status' => 'expire'], $check_log['id']);
								self::user_login_true();
								return true;
							}
							else
							{
								\dash\notif::error(T_("Invalid code"));
								return false;
							}
						}
						else
						{
							\dash\notif::error(T_("Verification code not set"));
							return false;
						}
					}
					else
					{
						\dash\notif::error(T_("Verification code was expired"));
						return false;
					}
				}
				else
				{
					\dash\notif::error(T_("Verification code not found"));
					return false;
				}
			}
			else
			{
				\dash\notif::error(T_("Verification code not found"));
				return false;
			}
		}
	}

	private static function user_login_true()
	{
		$result      = [];

		$new_user_id = self::$mobile_user_id;

		$old_user_id = \dash\user::id();

		$token       = \dash\header::get('token');

		$load_token  = \dash\db\user_auth::get(['auth' => $token, 'limit' => 1]);

		if(isset($load_token['gateway']) && isset($load_token['gateway_id']))
		{
			switch ($load_token['gateway'])
			{
				case 'android':
					\dash\db\user_android::update(['user_id' => $new_user_id, 'lastupdate' => date("Y-m-d H:i:s")], $load_token['gateway_id']);
					break;
			}
		}

		\dash\db\user_auth::update(['status' => 'expire'], $load_token['id']);

		$apikey = \dash\app\user_auth::make_user_auth($new_user_id, $load_token['gateway'], $load_token['gateway_id']);

		self::$response['apikey'] = $apikey;

		\dash\notif::ok(T_("Code is ok"));

		return true;
	}
}
?>