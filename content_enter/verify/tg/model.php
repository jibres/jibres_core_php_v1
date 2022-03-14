<?php
namespace content_enter\verify\tg;


class model
{

	public static function post()
	{
		if(!\dash\engine\store::inStore())
		{
			\dash\notif::warn(T_("Please start the telegram bot and send /sync request"));
			return false;
		}


		if(\dash\request::post('ididit') === 'yes')
		{
			$my_mobile = \content_enter\verify\sms\model::detect_mobile();

			if($my_mobile)
			{
				$result = \lib\api\jibres\api::fetch_telegram_chat_id(['mobile' => $my_mobile]);

				$ok = self::update_user_chat_id($result);

				if($ok)
				{

					$select_way = 'verify/telegram';
					\dash\utility\enter::open_lock($select_way);
					\dash\utility\enter::go_to($select_way);
				}
			}
			else
			{
				\dash\notif::error(T_("Can not detect your mobile"));
				return false;
			}
		}
	}


	private static function update_user_chat_id($_result)
	{
		if(a($_result, 'ok') === false)
		{
			return false;
		}

		$result = a($_result, 'result');

		if(!is_array($result))
		{
			return false;
		}


		if(a($result, 'mobile') && is_array(a($result, 'chat_id')))
		{

			$user_detail = \dash\db\users::get_by_mobile($result['mobile']);

			$user_id = null;

			if(isset($user_detail['id']))
			{
				$user_id = $user_detail['id'];
			}
			else
			{
				$user_id = \dash\app\user::quick_add(['mobile' => $result['mobile']]);
			}

			$user_chat_ids = \dash\db\user_telegram::get(['user_id' => $user_id]);

			if(!$user_chat_ids)
			{
				foreach (a($result, 'chat_id') as $k => $v)
				{
					$insert_chat_id =
					[
						'user_id'    => $user_id,
						'chatid'     => a($v, 'chatid'),
						'firstname'  => a($v, 'firstname'),
						'lastname'   => a($v, 'lastname'),
						'username'   => a($v, 'username'),
						'language'   => a($v, 'language'),
						'status'     => a($v, 'status'),
						'lastupdate' => a($v, 'lastupdate'),
					];

					\dash\db\user_telegram::insert($insert_chat_id);
				}
			}
			else
			{

				foreach ($user_chat_ids as $saved_chat_id)
				{
					foreach ($result['chatid'] as $jibres_chat_id)
					{
						if(strval(a($jibres_chat_id, 'chatid')) === strval(a($saved_chat_id, 'chatid')))
						{
							$must_update = [];

							if(a($jibres_chat_id, 'firstname') != a($saved_chat_id, 'firstname'))
							{
								$must_update['firstname'] = $jibres_chat_id['firstname'];
							}

							if(a($jibres_chat_id, 'lastname') != a($saved_chat_id, 'lastname'))
							{
								$must_update['lastname'] = $jibres_chat_id['lastname'];
							}

							if(a($jibres_chat_id, 'username') != a($saved_chat_id, 'username'))
							{
								$must_update['username'] = $jibres_chat_id['username'];
							}

							if(a($jibres_chat_id, 'language') != a($saved_chat_id, 'language'))
							{
								$must_update['language'] = $jibres_chat_id['language'];
							}

							if(a($jibres_chat_id, 'status') != a($saved_chat_id, 'status'))
							{
								$must_update['status'] = $jibres_chat_id['status'];
							}

							if(a($jibres_chat_id, 'lastupdate') != a($saved_chat_id, 'lastupdate'))
							{
								$must_update['lastupdate'] = $jibres_chat_id['lastupdate'];
							}


							if(!empty($must_update))
							{
								\dash\db\user_telegram::update($must_update, $saved_chat_id['id']);
							}

						}
					}
				}
			}
		}
		return true;
	}
}
?>