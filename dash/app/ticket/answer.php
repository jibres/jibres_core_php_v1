<?php
namespace dash\app\ticket;

class answer
{

	public static function add($_args, $_id)
	{
		\dash\permission::access('crmTicketManager');

		$master = \dash\app\ticket\get::inline_get($_id);
		if(!$master)
		{
			return false;
		}

		if(isset($master['parent']) && $master['parent'])
		{
			\dash\noitf::error(T_("Can not answer to this message!"));
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
		$args['user_id']     = \dash\user::id();
		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['type']        = 'ticket';
		$args['ip']          = \dash\server::ip(true);

		$sendmessage = false;

		if($args['sendmessage'])
		{
			$sendmessage = true;
		}

		unset($args['sendmessage']);

		$message_id = \dash\db\tickets\insert::new_record($args);

		if(!$message_id)
		{
			\dash\notif::error(T_("Can not add your message"));
			return false;
		}

		if(isset($file['id']))
		{
			\dash\upload\support::ticket_usage($file, $message_id);
		}

		\dash\notif::ok(T_('Your message saved'));

		return true;


	}


}
?>