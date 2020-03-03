<?php
namespace content_v2\account\session;


class view
{
	public static function config()
	{
		if(!\dash\user::login())
		{
			return false;
		}

		$user_id = \dash\user::id();
		$list    = \dash\db\sessions::get_active_sessions($user_id);

		$mySessionData = [];

		if(!$list)
		{
			\dash\notif::warn(T_("No session founded"));

		}
		else
		{

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

		}

		\content_v2\tools::say($mySessionData);
	}
}
?>