<?php
namespace lib\app\discount;


class remove
{

	public static function remove($_id)
	{
		\dash\permission::access('manageDiscountCode');

		$load = \lib\app\discount\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		// check usage
		$check_usage = \lib\db\factors\get::check_used_discount_id($load['id']);

		if($check_usage)
		{
			// \dash\notif::error(T_("Can not remove discount because this discount is used in some orders"));
			\lib\db\discount\update::update(['status' => 'deleted', 'datemodified' => date("Y-m-d H:i:s")], $load['id']);
			return true;
		}
		else
		{

			\lib\db\discount_lookup\delete::by_discount_id($load['id']);
			\lib\db\discount_dedicated\delete::by_discount_id($load['id']);
			\lib\db\discount\delete::by_id($load['id']);
		}

		return true;
	}

}
?>