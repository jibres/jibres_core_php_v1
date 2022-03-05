<?php
namespace dash\app\telegram;


class queue
{
	public static function add_one($_mobile, $_telegram_message_array, $_meta = [])
	{
		if(!$_mobile || !$_telegram_message_array || !is_array($_telegram_message_array))
		{
			return false;
		}

		$load_user = \dash\db\users::get_by_mobile($_mobile);

		if(!$load_user || !isset($load_user['id']))
		{
			return false;
		}


		$user_chatid = \dash\db\user_telegram::get(['user_id' => $load_user['id']]);

		if(!$user_chatid || !is_array($user_chatid))
		{
			return;
		}


		foreach ($user_chatid as $key => $value)
		{
			if(array_key_exists('chat_id', $_telegram_message_array))
			{
				$method = 'sendMessage';

				if(a($_telegram_message_array, 'method'))
				{
					$method = $_telegram_message_array['method'];
				}

				$_telegram_message_array['chat_id'] = $value['chatid'];

				$insert_telegram_queue =
				[
					'store_id'             => a($_meta, 'store_id'),
					'store_telegramlog_id' => null,
					'chatid'               => $value['chatid'],
					'type'                 => null,
					'status'               => 'pending',
					'method'               => $method,
					'bot'                  => a($_meta, 'active_bot'),
					'send'                 => json_encode($_telegram_message_array),
					'dateregister'         => date("Y-m-d H:i:s"),
					'datecreated'          => date("Y-m-d H:i:s"),
				];

				$telegram_queue_id = \dash\db\telegrams\insert::insert_telegram_api_log($insert_telegram_queue);
				if($telegram_queue_id)
				{

					$insert_telegram_queue_sending =
					[
						'telegram_id' => $telegram_queue_id,
						'status'      => 'pending',
						'datecreated' => date("Y-m-d H:i:s"),
					];

					\dash\db\telegrams\insert::insert_telegram_sending_api_log($insert_telegram_queue_sending);
				}
			}
		}

		return true;

	}



	public static function send_real_time($_debug = false)
	{
		$get_sending_list = \dash\db\telegrams\get::not_sended_list();

		if(!$get_sending_list)
		{
			return;
		}

		// \dash\pdo::transaction('api_log');

		$ids = array_column($get_sending_list, 'id');

		if(!$ids)
		{
			return;
		}


		// update all status of this list as sending to not load in another session
		\dash\db\telegrams\update::set_sending_list(implode(',', $ids));

		$telegram_ids = array_column($get_sending_list, 'telegram_id');

		$telegram_list = \dash\db\telegrams\get::by_multi_id(implode(',', $telegram_ids));

		if(!is_array($telegram_list))
		{
			$telegram_list = [];
		}

		if(!$telegram_list)
		{
			return false;
		}


		foreach ($telegram_list as $key => $value)
		{
			$active_bot = 'master';


			if(isset($value['bot']) && $value['bot'])
			{
				$active_bot = $value['bot'];
			}


			$send = json_decode($value['send'], true);

			\dash\setting\telegram::active_bot($active_bot);

			\dash\social\telegram\exec::reset_hit();

			if(isset($send['method']))
			{
				$method   = $send['method'];
				unset($send['method']);
				$myResult = \dash\social\telegram\tg::$method($send);
			}
			else
			{
				$myResult = \dash\social\telegram\tg::sendMessage($send);
			}

			$update =
			[
				'status'       => 'sended',
				'response'     => json_encode($myResult),
				'dateresponse' => date("Y-m-d H:i:s"),
				'datemodified' => date("Y-m-d H:i:s"),
			];

			\dash\db\telegrams\update::record_api_log($update, $value['id']);

		}

		\lib\db\sms\delete::sending_by_multi_id(implode(',', $ids));

	}
}
?>