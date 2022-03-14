<?php
namespace content_r10\jibres\telegram;


class model
{
	public static function post()
	{
		$mobile = \dash\request::input_body('mobile');

		$mobile = \dash\validate::mobile($mobile);
		if(!$mobile)
		{
			\dash\notif::error(T_("Invalid mobile"));
			return false;
		}

		$load_user = \dash\db\users::get_by_mobile($mobile);

		if(!$load_user || !isset($load_user['id']))
		{
			\dash\notif::error(T_("You have not yet start the Telegram robot and have not sent the sync request!"));
			return false;
		}


		$user_chatid = \dash\db\user_telegram::get(['user_id' => $load_user['id']]);

		if(!$user_chatid || !is_array($user_chatid))
		{
			\dash\notif::error(T_("You have not yet start the Telegram robot and have not sent the sync request"));
			return false;
		}


		$result_chat_id = [];

		foreach ($user_chatid as $key => $value)
		{
			$result_chat_id[] =
			[
				'chatid'      => a($value, 'chatid'),
				'firstname'   => a($value, 'firstname'),
				'lastname'    => a($value, 'lastname'),
				'username'    => a($value, 'username'),
				'language'    => a($value, 'language'),
				'status'      => a($value, 'status'),
				'lastupdate'  => a($value, 'lastupdate'),
			];
		}

		$result =
		[
			'mobile'  => $mobile,
			'chat_id' => $result_chat_id,
		];

		\content_r10\tools::say($result);

	}
}
?>