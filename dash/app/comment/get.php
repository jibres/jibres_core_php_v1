<?php
namespace dash\app\comment;

class get
{
/**
	 * Gets the user.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The user.
	 */
	public static function get($_id)
	{

		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid comments id"));
			return false;
		}

		$detail = \dash\db\comments\get::by_id($id);

		$temp = [];

		if(is_array($detail))
		{
			$temp = \dash\app\comment\ready::row($detail);
		}

		return $temp;
	}


	public static function inline_get($_id)
	{

		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid comments id"));
			return false;
		}

		$detail = \dash\db\comments\get::by_id($id);

		if(!is_array($detail))
		{
			$detail = [];
		}

		return $detail;
	}

}
?>