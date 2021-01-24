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