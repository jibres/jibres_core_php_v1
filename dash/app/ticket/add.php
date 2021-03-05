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
	public static function add_new_ticket($args, $_type = null)
	{
		unset($args['sendmessage']);

		$file = null;
		// only if user login can add file to ticket
		if(\dash\user::id() && \dash\request::files('file'))
		{
			$file = \dash\upload\support::ticket();
			if(!isset($file['path']))
			{
				return false;
			}

			$args['file'] = $file['path'];
		}

		if(isset($args['parent']) && $args['parent'])
		{
			$count_in_ticket = \dash\db\tickets\get::count_by_parent($args['parent']);

			if(floatval($count_in_ticket) >= 500 + 1) // 500 + master ticket
			{
				\dash\notif::error(T_("Can not add any message to this ticket. The capacity of this ticket is full!"));
				return false;
			}
		}

		$myIp     = \dash\server::iplong();
		$agent_id = \dash\agent::get(true);

		if(!a($args, 'ip'))
		{
			$args['ip'] = $myIp;
		}

		if(!a($args, 'agent_id'))
		{
			$args['agent_id'] = $agent_id;
		}

		if($_type === 'new')
		{
			// check limit new ticket
			if(\dash\user::id())
			{
				$count_unanswered_user_ticket = \dash\db\tickets\get::count_unanswered_user_ticket(\dash\user::id());

				if($count_unanswered_user_ticket >= 5)
				{
					\dash\notif::error(T_("Please wait until your active ticket was answered"));
					return false;
				}
			}
			else
			{
				// first check per ip
				$count_unanswered_ip_ticket = \dash\db\tickets\get::count_unanswered_ip_ticket($myIp);

				if($count_unanswered_ip_ticket >= 10)
				{
					\dash\notif::error(T_("Please wait until your active ticket was answered!"));
					return false;
				}
				else
				{
					// check per ip agent
					$count_unanswered_ip_agent_ticket = \dash\db\tickets\get::count_unanswered_ip_agent_ticket($myIp, $agent_id);

					if($count_unanswered_ip_agent_ticket >= 3)
					{
						\dash\notif::error(T_("Please wait until your active ticket was answered."));
						return false;
					}
				}
			}
		}
		elseif($_type === 'add_to_my_ticket' && a($args, 'parent'))
		{

			if(\dash\user::id())
			{
				$count_user_message  = \dash\db\tickets\get::count_user_message($args['parent']);
				$count_admin_message = \dash\db\tickets\get::count_admin_message($args['parent']);
				$index = 5;
			}
			else
			{
				$index = 3;
				$count_user_message  = \dash\db\tickets\get::count_user_message_guest($args['parent']);
				$count_admin_message = \dash\db\tickets\get::count_admin_message_guest($args['parent']);
			}

			$rate = $count_admin_message * $index + $index;

			if($count_user_message >= $rate)
			{
				\dash\notif::error(T_("Please wait until ticket was answered"));
				return false;
			}
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
	public static function add($_args, $_option = [])
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

		$ticket_id = self::add_new_ticket($args, 'new');
		if(!$ticket_id)
		{
			return false;
		}

		$log =
		[
			'from'     => $args['user_id'] ? $args['user_id'] : null,
			'code'     => $ticket_id,
			'masterid' => $ticket_id,
			'via'      => null,
		];

		\dash\log::set('ticket_addNewTicket', $log);

		$result = [];
		$result['id'] = $ticket_id;

		if(isset($_option['silent']) && $_option['silent'])
		{
			// silent mode !
		}
		else
		{
			\dash\notif::ok(T_("Ticket added"));
		}
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

		$ticket_id = self::add_new_ticket($args, 'add_to_my_ticket');
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
			'code'     => $ticket_id,
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

		$ticket_id = self::add_new_ticket($args, 'add_by_admin');
		if(!$ticket_id)
		{
			\dash\notif::error(T_("Can not add your ticket"));
			return false;
		}


		// $log =
		// [
		// 	'from'     => $args['user_id'] ? $args['user_id'] : null,
		// 	'code'     => $ticket_id,
		// 	'masterid' => $ticket_id,
		// 	'via'      => null,
		// ];

		// \dash\log::set('ticket_addNewTicket', $log);

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