<?php
namespace content_v2\account\session;


class model
{
	public static function post()
	{
		if(\content_v2\tools::input_body('type') === 'terminateall')
		{
			\dash\db\sessions::terminate_all_other(\dash\user::id());
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
				$session_detail = \dash\db\sessions::is_my_session($session_id, \dash\user::id());
				if($session_detail && isset($session_detail['status']))
				{
					switch ($session_detail['status'])
					{
						case 'active':
							\dash\log::set('sessionTerminate');
							\dash\db\sessions::terminate_id($session_id);
							\dash\notif::ok(T_("This Session was terminated"));
							return true;
							break;

						default:
							\dash\notif::warn(T_("This Session is not active"));
							return null;
							break;
					}
				}
				else
				{
					\dash\log::set('APIthisIsNotYourSession');
					\dash\notif::error(T_("This is not your session"));
					return false;
				}
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