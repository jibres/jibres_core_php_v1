<?php
namespace content_v2\account\session;


class controller
{
	public static function routing()
	{
		\content_v2\tools::invalid_url();
	}

	public static function api_routing()
	{
		if(\dash\url::dir(4))
		{
			\content_v2\tools::invalid_url();
		}

		$result = null;

		if(\dash\request::is('get'))
		{
			$result = self::get_session();
		}
		elseif(\dash\request::is('post'))
		{
			$result = self::terminate_session();
		}
		else
		{
			\content_v2\tools::invalid_method();
		}


		\content_v2\tools::say($result);
	}



	public static function get_session()
	{
		if(!\dash\user::login())
		{
			return false;
		}

		$user_id = \dash\user::id();
		$list    = \dash\db\sessions::get_active_sessions($user_id);

		if(!$list)
		{
			\dash\notif::warn(T_("No session founded"));
			return false;
		}

		// \dash\data::currentCookie(\dash\db\sessions::get_cookie());

		$mySessionData = [];
		foreach ($list as $key => $row)
		{
			@$mySessionData[$key]['id']         = \dash\coding::encode($row['id']);
			@$mySessionData[$key]['ip']         = long2ip($row['ip']);
			@$mySessionData[$key]['last']       = \dash\datetime::fit($row['last_seen'], true);
			@$mySessionData[$key]['browser']    = T_(ucfirst($row['agent_name']));
			@$mySessionData[$key]['browserVer'] = $row['agent_version'];
			@$mySessionData[$key]['os']         = $row['agent_os'];
			@$mySessionData[$key]['os_version'] = T_($row['agent_osnum']);

			if(isset($row['agent_os']))
			{
				switch ($row['agent_os'])
				{
					case 'nt':
						$mySessionData[$key]['os'] = T_('Windows');
						break;

					case 'lin':
						$mySessionData[$key]['os'] = T_('Linux');
						break;

					default:
						$mySessionData[$key]['os'] = $row['agent_os'];
						break;
				}
			}
		}

		return $mySessionData;

	}


	private static function terminate_session()
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