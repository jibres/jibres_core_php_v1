<?php
namespace content_enter\callback;


class model
{
	public static function post()
	{
		switch (\dash\request::get('service'))
		{
			case 'kavenegar':
				self::kavenegar();
				break;

			default:
				\dash\header::status(404, T_("Invalid service"));
				break;
		}
	}

	public static function kavenegar()
	{
		\dash\log::set('enter:callback:sms:resieve');

		$condition =
		[
			'from'    => 'mobile',
			'message' => 'string_500',
		];

		$args =
		[
			'from'    => \dash\request::post('from'),
			'message' => \dash\request::post('message'),
		];

		$require = [];
		$meta    = [];

		$data = \dash\cleanse::input($args, $condition, $require, $meta);

		$message = $data['message'];

		if(!$message)
		{
			\dash\log::set('enter:callback:message:empty');
			\dash\notif::error(T_("Message is empty"));
			return false;
		}


		$mobile = $data['from'];

		if(!$mobile)
		{
			\dash\log::set('enter:callback:from:not:set');
			\dash\notif::error(T_("Mobile not set"));
			return false;
		}

		$user_data = \dash\db\users::get_by_mobile($mobile);

		if(!$user_data || !isset($user_data['id']))
		{
			return self::first_signup_sms($mobile);
		}

		// the message is not a verification code
		if(!\dash\validate::verification_code($message))
		{
			return false;
		}

		$user_id = $user_data['id'];

		$find_log =
		[
			'caller' => 'enterGetSmsFromUser',
			'to'     => $user_id,
			'code'   => $message,
			'status' => 'enable',
		];

		$find_log = \dash\db\logs::get($find_log);

		$log_detail = ['from' => $user_id];

		if(!$find_log || !is_array($find_log) || count($find_log) === 0)
		{
			\dash\log::set('enter:callback:sms:resieve:log:not:found', $log_detail);
			\dash\notif::error(T_("Log not found"));
			return false;
		}

		if(count($find_log) > 1)
		{
			\dash\log::set('enter:callback:sms:more:than:one:log:found', $log_detail);
			foreach ($find_log as $key => $value)
			{
				if(isset($value['id']))
				{
					\dash\db\logs::update(['status' => 'expire'], $value['id']);
				}
			}
			\dash\notif::error(T_("More than one log found"));
			return false;
		}


		if(count($find_log) === 1)
		{
			$find_log = $find_log[0];
			if(isset($find_log['id']))
			{
				\dash\db\logs::update(['status' => 'deliver'], $find_log['id']);
				\dash\notif::ok(T_("OK"));
				return true;
			}
		}

		// {
		// 	"get":"service=kavenegar&type=recieve&uid=201700001",
		// 	"post":
		// 		{
		// 			"messageid":"308404060",
		// 			"from":"09109610612",
		// 			"to":"10006660066600",
		// 			"message":"Salamq"
		// 		}
		// 	}
	}


	/**
	 * singup user and send the regirster sms to he
	 */
	private static function first_signup_sms($_mobile)
	{


		$signup =
		[
			'mobile'      => $_mobile,
			'password'    => null,
			'displayname' => null,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$user_id = \dash\app\user::quick_add($signup);

		\dash\log::set('enter:callback:signup:by:sms');

		$msg    = T_("Your register was complete");

		// $kavenegar_send_result = \dash\utility\sms::send($mobile, $msg);


		// \dash\log::set('enter:callback:sms:registe:reasult');

		\dash\notif::ok(T_("User signup by sms"));


	}
}
?>