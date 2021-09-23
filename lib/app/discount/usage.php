<?php
namespace lib\app\discount;


class usage
{
	public static function user_usage_count($_discount_id, $_user_id)
	{
		$discount_id = \dash\validate::id($_discount_id, false);
		$user_id     = \dash\validate::id($_user_id, false);

		if($discount_id && $user_id)
		{
			$count = \lib\db\factors\get::user_discount_usage_count($discount_id, $user_id);

			return intval($count);
		}

		return false;
	}


	public static function total_count($_discount_id)
	{
		$discount_id = \dash\validate::id($_discount_id, false);

		if($discount_id)
		{
			$count = \lib\db\factors\get::discount_usage_total_count($discount_id);

			return intval($count);
		}

		return false;
	}
}
?>