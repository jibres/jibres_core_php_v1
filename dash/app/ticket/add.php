<?php
namespace dash\app\ticket;

class add
{

	public static function add($_args)
	{

		$args = \dash\app\ticket\check::variable($_args, null, true);
		if(!$args)
		{
			return false;
		}

		if(isset($args['content']))
		{
			$count_http  = substr_count($args['content'], 'http://');
			$count_https = substr_count($args['content'], 'https://');
			if($count_https + $count_http >= 2)
			{
				\dash\notif::error(T_("Can not set 2 link in one message!"));
				return false;
			}
		}

		$file = null;
		if(\dash\request::files('file'))
		{
			$file = \dash\upload\support::ticket();
			if(!isset($file['path']))
			{
				return false;
			}

			$args['file'] = $file['path'];
		}

		$ticket_id = \dash\db\tickets\insert::new_record($args);
		if(!$ticket_id)
		{
			\dash\notif::error(T_("Can not add your ticket"));
			return false;
		}

		if(isset($file['id']))
		{
			\dash\upload\support::ticket_usage($file, $ticket_id);
		}

		$result = [];
		$result['id'] = $ticket_id;


		\dash\notif::ok(T_("Ticket added"));
		return $result;


	}


	public static function to_my_ticket($_args, $_id)
	{
		$master = \dash\app\ticket\get::my_ticket($_id);
		if(!$master)
		{
			return false;
		}

		if(isset($master['parent']) && $master['parent'])
		{
			\dash\notif::error(T_("Can not add messge to this ticket id!"));
			return false;
		}


		$args = \dash\app\ticket\check::variable($_args);
		if(!$args)
		{
			return false;
		}

		$file = null;
		if(\dash\request::files('file'))
		{
			$file = \dash\upload\support::ticket();
			if(!isset($file['path']))
			{
				return false;
			}

			$args['file'] = $file['path'];
		}

		$args['parent']      = $master['id'];

		unset($args['sendmessage']);

		$message_id = \dash\db\tickets\insert::new_record($args);

		if(!$message_id)
		{
			\dash\notif::error(T_("Can not add your message"));
			return false;
		}

		$update_master           = [];
		$update_master['status'] = 'awaiting';

		$plus = \dash\db\tickets\get::conversation_count($master['id']);
		if(is_numeric($plus))
		{
			$update_master['plus'] = $plus;
		}
		else
		{
			$plus = 1; // error. Bug. But need this variable :/
		}

		\dash\db\tickets\update::update($update_master, $master['id']);

		$log =
		[
			'masterid' => $master['id'],
			'code'     => $master['id'],
			'plus'     => $plus,
			'from'     => \dash\user::id(),
		];

		\dash\log::set('ticket_AddToTicket', $log);

		if(isset($file['id']))
		{
			\dash\upload\support::ticket_usage($file, $message_id);
		}

		\dash\notif::ok(T_('Your message saved'));

		return true;

	}

	public static function add_by_admin($_args)
	{

		if(!a($_args, 'user_id'))
		{
			\dash\notif::error(T_("Please choose the customer"), 'user_id');
			return false;
		}


		$args = \dash\app\ticket\check::variable($_args);
		if(!$args)
		{
			return false;
		}



		$file = null;
		if(\dash\request::files('file'))
		{
			$file = \dash\upload\support::ticket();
			if(!isset($file['path']))
			{
				return false;
			}

			$args['file'] = $file['path'];
		}

		$ticket_id = \dash\db\tickets\insert::new_record($args);
		if(!$ticket_id)
		{
			\dash\notif::error(T_("Can not add your ticket"));
			return false;
		}

		if(isset($file['id']))
		{
			\dash\upload\support::ticket_usage($file, $ticket_id);
		}

		$result = [];
		$result['id'] = $ticket_id;




		\dash\notif::ok(T_("Ticket added"));
		return $result;


	}



	public static function branch($_master_id, $_child_id)
	{
		\dash\permission::access('crmTicketManager');

		$master = \dash\app\ticket\get::inline_get($_master_id);
		if(!$master)
		{
			return false;
		}


		$child = \dash\app\ticket\get::inline_get($_child_id);
		if(!$child)
		{
			return false;
		}



		if(isset($child['parent']) && floatval($child['parent']) === floatval($master['id']))
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Can not add branch by this message"));
			return false;
		}

		$new =
		[
			'title'   => $master['title'],
			'content' => $child['content'],
			'user_id' => \dash\coding::encode($child['user_id']),
			'base'    => $child['id'],
			'file'    => $child['file'],
			'ip'      => $child['ip'],
		];

		$new_ticket = self::add_by_admin($new);

		if(isset($new_ticket['id']))
		{
			\dash\db\tickets\update::update(['branch' => $new_ticket['id']], $child['id']);
		}

		return $new_ticket;

	}


}
?>