<?php
namespace dash\app\ticket;

class get
{


	public static function check_unanswer_ticket()
	{
		$count_unanswered_ticket = \dash\db\tickets\get::count_unanswered_ticket();

		$count_unanswered_ticket = intval($count_unanswered_ticket);
		if($count_unanswered_ticket > 0)
		{
			\dash\log::set('ticket_notAnsweredTicket', ['my_count' => $count_unanswered_ticket]);
		}
	}

	public static function get($_id)
	{
		\dash\permission::access('crmShowTicketsList');

		$load = self::inline_get($_id);

		if(!$load)
		{
			return false;
		}

		if(isset($load['user_id']) && $load['user_id'])
		{
			$email = \dash\app\user\email::get_user_email_primary($load['user_id']);

			$chatid = \dash\db\user_telegram\get::load_user_chatid($load['user_id']);

			if(isset($email['email']))
			{
				$load['useremail'] = $email['email'];
			}

			if(isset($chatid['username']))
			{
				$load['usertelegram'] = $chatid['username'];
			}
			elseif(isset($chatid['chatid']))
			{
				$load['usertelegram'] = $chatid['chatid'];
			}
		}

		$load = \dash\app\ticket\ready::row($load);

		return $load;
	}


	public static function inline_get($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$load = \dash\db\tickets\get::get($id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Data not founded"));
			return false;
		}

		return $load;
	}



	public static function my_ticket($_id = null, $_website_mode = false)
	{
		if($_id)
		{
			$id = $_id;
		}
		else
		{
			$id = \dash\request::get('id');
		}

		$id = \dash\validate::id($id);
		if(!$id)
		{
			return false;
		}

		$guestid = null;
		$user_id = \dash\user::id();
		if(!$user_id)
		{
			$guestid = \dash\user::get_user_guest();
			if(!$guestid)
			{
				if($_website_mode)
				{
					// redirect to login to login user and see it
					\dash\redirect::to_login();
				}
				else
				{
					return false;
				}
			}
		}

		if($user_id)
		{
			$load = \dash\db\tickets\get::load_my_ticket($id, $user_id, $guestid);
		}
		elseif($guestid)
		{
			$load = \dash\db\tickets\get::load_my_ticket_guestid($id, $guestid);
		}
		else
		{
			return false;
		}


		if(!$load)
		{
			return false;
		}

		$load = \dash\app\ticket\ready::row($load);


		return $load;


	}

	public static function conversation($_id, $_customer_mode = false)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$conversation = \dash\db\tickets\get::conversation($id, $_customer_mode);
		if(!is_array($conversation))
		{
			$conversation = [];
		}


		$conversation = array_map(['\\dash\\app\\ticket\\ready', 'row'], $conversation);

		if($_customer_mode)
		{
			$endMessage = a($conversation, 0);

			if(a($endMessage, 'parent') && !a($endMessage, 'see') && a($endMessage, 'type') === 'answer')
			{
				$log =
				[
					'from'     => \dash\user::id(),
					'code'     => a($endMessage, 'id'),
					'masterid' => a($endMessage, 'parent'),
				];

				\dash\db\tickets\update::update(['see' => 1], $endMessage['id']);

				\dash\log::set('ticket_seeTicket', $log);
			}
		}

		// calculate some stat
		$message_count    = 0;
		$message_total    = 0;
		$attachment_count = 0;
		$answer_count     = 0;
		$master_message   = null;
		$userinticket     = [];
		foreach ($conversation as $key => $value)
		{
			if(isset($value['id']) && floatval($value['id']) === floatval($id))
			{
				$master_message = $value;
				break;
			}
		}

		$last_user = null;
		foreach ($conversation as $key => $value)
		{

			if(a($value, 'user_id') !== $last_user)
			{
				$last_user = a($value, 'user_id');
			}
			else
			{
				$conversation[$key]['dbluser'] = true;
			}
			$message_total++;

			if(isset($value['user_id']))
			{
				if($value['user_id'] === a($master_message, 'user_id'))
				{
					$message_count++;
				}
				else
				{
					if(!isset($userinticket[$value['user_id']]))
					{
						$userinticket[$value['user_id']] =
						[
							'avatar' => a($value, 'avatar'),
							'displayname' => a($value, 'displayname'),
						];
					}
					$answer_count++;
				}
			}
			else
			{
				$message_count++;
			}

			if(isset($value['file']) && $value['file'])
			{
				$attachment_count++;
			}
		}

		if(isset($conversation[0]) && is_array($conversation[0]))
		{
			$conversation[0]['messagecount']    = $message_count;
			$conversation[0]['attachmentcount'] = $attachment_count;
			$conversation[0]['answercount']     = $answer_count;
			$conversation[0]['messagetotal']    = $message_total;
			$conversation[0]['userinticket']    = $userinticket;
		}

		return $conversation;
	}
}
?>