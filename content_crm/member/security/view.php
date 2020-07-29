<?php
namespace content_crm\member\security;


class view
{

	public static function config()
	{
		\content_crm\member\main\view::dataRowMember();

		\dash\face::title(T_('Edit user security'));

		\dash\data::action_link(\dash\url::this());
		\dash\data::action_text(T_('Back to dashbaord'));

		if(\dash\permission::check("cpUsersPermission"))
		{
			$perm_list = \dash\permission::groups();
			\dash\data::permGroup($perm_list);
		}

		$chatid_list = \dash\db\user_telegram::get(['user_id' => \dash\coding::decode(\dash\request::get('id'))]);

		\dash\data::chatIdList($chatid_list);


		$androidList = \dash\db\user_android::get(['user_id' => \dash\coding::decode(\dash\request::get('id'))]);

		\dash\data::androidList($androidList);

		self::session_list();
		self::login_list();
	}


	private static function login_list()
	{
		// $args = [];
		// $args['caller'] = ["IN", "('userLogin', 'userLoginByRemember')"];
		// $args['from'] = \dash\coding::decode(\dash\request::get('id'));
		// \content_crm\log\home\view::search_log($args);

	}


	public static function session_list()
	{
		$user_id = \dash\coding::decode(\dash\request::get('id'));

		$list    = \dash\db\sessions::get_active_sessions($user_id);

		if(!$list)
		{
			return false;
		}

		$mySessionData = [];
		foreach ($list as $key => $row)
		{
			@$mySessionData[$key]['id']         = $row['id'];
			@$mySessionData[$key]['code']       = $row['code'];
			@$mySessionData[$key]['ip']         = long2ip($row['ip']);
			@$mySessionData[$key]['last']       = $row['last_seen'];
			@$mySessionData[$key]['browser']    = T_(ucfirst($row['agent_name']));
			@$mySessionData[$key]['browserVer'] = $row['agent_version'];
			@$mySessionData[$key]['os']         = $row['agent_os'];
			@$mySessionData[$key]['osVer']      = T_($row['agent_osnum']);

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
						break;
				}
			}
		}

		\dash\data::sessionsList($mySessionData);
	}
}
?>
