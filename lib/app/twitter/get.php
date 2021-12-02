<?php
namespace lib\app\twitter;

class get
{
	public static function get($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$result = \lib\db\twitter\get::by_id($id);
		return $result;
	}
}
?>