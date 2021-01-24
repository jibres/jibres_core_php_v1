<?php
namespace dash\app\ticket;

class add
{

	/**
	 * Adds a new ticket.
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function add_new_ticket($args)
	{
		unset($args['sendmessage']);

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

		return $ticket_id;
	}


	/**
	 * Adds New ticetk by customer
	 *
	 * @param      <type>         $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
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

		if(!$args['user_id'])
		{
			$guestid = \dash\user::get_user_guest(true);
			if(!$guestid)
			{
				\dash\notif::error(T_("Please login to continue"));
				return false;
			}

			$args['guestid'] = $guestid;
		}

		$ticket_id = self::add_new_ticket($args);
		if(!$ticket_id)
		{
			return false;
		}

		$result = [];
		$result['id'] = $ticket_id;


		\dash\notif::ok(T_("Ticket added"));
		return $result;
	}


	/**
	 * Customer add new message to ticket
	 *
	 * @param      <type>   $_args  The arguments
	 * @param      <type>   $_id    The identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
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

		if(!$args['user_id'])
		{
			$guestid = \dash\user::get_user_guest(true);
			if(!$guestid)
			{
				\dash\notif::error(T_("Please login to continue"));
				return false;
			}

			$args['guestid'] = $guestid;
		}

		$args['parent']      = $master['id'];

		$ticket_id = self::add_new_ticket($args);
		if(!$ticket_id)
		{
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


		\dash\notif::ok(T_('Your message saved'));

		return true;

	}


	/**
	 * Add new ticket by admin.
	 *
	 * @param      <type>         $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add_by_admin($_args)
	{
		\dash\permission::access('crmTicketManager');

		if(!a($_args, 'user_id'))
		{
			\dash\notif::error(T_("Please choose the customer"), 'user_id');
			return false;
		}

		$_args['user_id'] = \dash\coding::decode($_args['user_id']);


		$args = \dash\app\ticket\check::variable($_args);
		if(!$args)
		{
			return false;
		}

		$ticket_id = self::add_new_ticket($args);
		if(!$ticket_id)
		{
			\dash\notif::error(T_("Can not add your ticket"));
			return false;
		}

		$result = [];
		$result['id'] = $ticket_id;


		\dash\notif::ok(T_("Ticket added"));
		return $result;
	}


	/**
	 * Create a branch from one message of ticket
	 *
	 * @param      <type>   $_master_id  The master identifier
	 * @param      <type>   $_child_id   The child identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
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


	/**
	 * After login user assigned ticket in guest mode to user account
	 *
	 * @param      <type>   $_guest_id  The guest identifier
	 * @param      <type>   $_user_id   The user identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function assing_to_user($_guest_id, $_user_id)
	{

		$condition =
		[
			'user_id' => 'code',
			'guestid' => 'md5',
		];

		$args =
		[
			'user_id' => $_user_id,
			'guestid' => $_guest_id,
		];

		$require = ['guestid', 'user_id'];

		$meta    = [];

		$data    = \dash\cleanse::input($args, $condition, $require, $meta);

		$user_id = \dash\coding::decode($data['user_id']);

		\dash\db\tickets\update::assing_to_user($data['guestid'], $user_id);

		return true;

	}


}
?>