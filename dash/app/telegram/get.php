<?php
namespace dash\app\telegram;


class get
{
	public static function get($_id)
	{

		$result = self::inline_get($_id);

		if(!$result)
		{
			\dash\notif::error(T_("Terms not founded"));
			return false;
		}

		$result = \dash\app\telegram\ready::row($result);

		return $result;
	}


	public static function dashboard_detail()
	{
		$result = [];
		$result['totalfiles'] = floatval(\dash\db\telegrams::count_all());
		$result['totalsize'] = floatval(\dash\db\telegrams::total_size());

		return $result;
	}


	public static function inline_get($_id)
	{
		$id = \dash\validate::id($_id, false);
		if(!$id)
		{
			return false;
		}

		$result = \dash\db\telegrams\get::by_id($id);
		if(!$result || !is_array($result))
		{
			return false;
		}

		return $result;
	}


}
?>