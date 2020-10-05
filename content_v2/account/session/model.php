<?php
namespace content_v2\account\session;


class model
{
	public static function post()
	{
		if(\content_v2\tools::input_body('type') === 'terminateall')
		{
			\dash\login::terminate_all_other_session(\dash\user::id());
			\dash\log::set('APIsessionTerminateAll');
			\dash\notif::ok(T_("All other session terminated"));
			return true;
		}

		if(\content_v2\tools::input_body('type') === 'terminate')
		{
			$session_id = \content_v2\tools::input_body('id');

			if($session_id && \dash\coding::is($session_id))
			{
				$session_id = \dash\coding::decode($session_id);
				\dash\login::terminate_id($session_id, \dash\user::id())
			}
			else
			{
				\dash\notif::error(T_("Session id not send or invalid"), 'id');
				return false;
			}
		}
		else
		{
			\dash\notif::error(T_("Invalid type"), 'type');
			return false;
		}
	}
}
?>