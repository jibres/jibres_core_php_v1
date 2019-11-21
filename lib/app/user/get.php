<?php
namespace lib\app\user;


class get
{

	public static function get_full_name($_user_id, $_get_gender = false)
	{
		if(!$_user_id || !is_numeric($_user_id))
		{
			return false;
		}

		$load = \lib\db\users\users::get(['id' => $_user_id, 'limit' => 1]);
		$name = null;
		if(isset($load['firstname']) && isset($load['lastname']))
		{
			$name = trim($load['firstname']. ' '. $load['lastname']);
		}
		elseif(isset($load['displayname']))
		{
			$name = $load['displayname'];
		}

		if($_get_gender)
		{
			if(isset($load['gender']))
			{
				if($load['gender'] === 'male')
				{
					$name = T_("Mr"). ' '. $name;
				}
				elseif($load['gender'] === 'female')
				{
					$name = T_("Mrs"). ' '. $name;
				}
			}
		}

		return $name;
	}

	public static function get($_id)
	{
		$_id = \dash\coding::decode($_id);
		if(!$_id)
		{
			return false;
		}

		$result = \lib\db\users\users::get_by_id($_id);

		if(is_array($result))
		{
			return \lib\app\user\ready::row($result);
		}

		return $result;
	}
}
?>