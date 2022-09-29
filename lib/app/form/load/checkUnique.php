<?php
namespace lib\app\form\load;


class checkUnique
{

	public static function uniqueToken($_tokenDetail)
	{
		$ip_id    = a($_tokenDetail, 'ip_id');
		$agent_id = a($_tokenDetail, 'agent_id');
		$user_id  = a($_tokenDetail, 'user_id');
		$form_id  = a($_tokenDetail, 'form_id');

		return self::check($form_id, $user_id, $ip_id, $agent_id);

	}


	public static function uniqueIpAgent($_form_id)
	{
		$ip_id    = \dash\utility\ip::id();
		$agent_id = \dash\agent::get(true);
		$user_id  = \dash\user::id();

		return self::check($_form_id, $user_id, $ip_id, $agent_id);
	}


	private static function check($_form_id, $_user_id, $_ip_id, $_agent_id)
	{
		if($_user_id)
		{
			// only check unique by user id
			$answeredBefore = \lib\db\form_load\get::checkUniqueUserId($_form_id, $_user_id);
			if($answeredBefore)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			$answeredBefore = \lib\db\form_load\get::checkUniqueIpAgent($_form_id, $_ip_id, $_agent_id);
			if($answeredBefore)
			{
				return false;
			}
			else
			{
				return true;
			}
		}

	}

}
