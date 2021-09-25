<?php
namespace lib\app\discount;


class get
{


	public static function get($_id)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$result = \lib\db\discount\get::by_id($id);

		if(!$result)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$result = \lib\app\discount\ready::row($result);
		return $result;
	}



	public static function by_code($_code)
	{
		$code = \dash\validate::discount_code($_code, false);

		if(!$code)
		{
			return false;
		}

		$result = \lib\db\discount\get::by_code($code);

		if(!$result)
		{
			return false;
		}

		$result = \lib\app\discount\ready::row($result);

		return $result;
	}


	public static function summary($_id)
	{
		$id = \dash\validate::id($_id, false);
		if(!$id)
		{
			return false;
		}

		$result           = [];
		$result['used']   = \lib\db\factors\get::discount_usage_total_count($id);
		$result['lookup'] = \lib\db\discount_lookup\get::count_by_discount_id($id);

		return $result;
	}

}
?>