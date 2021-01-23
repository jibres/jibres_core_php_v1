<?php
namespace dash\app\ticket;

class add
{

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


}
?>