<?php

namespace lib\app\store_user;

class get
{

	public static function get($_id)
	{
		$id   = \dash\validate::id($_id);
		$load = \lib\db\store_user\get::by_id($id);
		if (!isset($load['id']))
		{
			return false;
		}

		return $load;

	}

}