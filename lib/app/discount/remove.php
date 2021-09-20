<?php
namespace lib\app\discount;


class remove
{

	public static function remove($_id)
	{
		$load = \lib\app\discount\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		// check usage
		$check_usage = false;
		if($check_usage)
		{
			\dash\notif::error(T_("Can not remove discount because this discount is used in some orders"));
			return false;
		}

		\lib\db\discount_lookup\delete::by_discount_id($load['id']);
		\lib\db\discount_dedicated\delete::by_discount_id($load['id']);
		\lib\db\discount\delete::by_id($load['id']);

		return true;
	}

}
?>