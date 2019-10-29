<?php
namespace lib\app\product;


class get
{
	public static function inline_get($_id)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!$_id)
		{
			\dash\notif::error(T_("Id not set"));
			return false;
		}


		if(!is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		// $id = \dash\coding::decode($_id);
		// if(!$id)
		// {
		// 	\dash\notif::error(T_("Invalid id"));
		// 	return false;
		// }

		$result = \lib\db\products\db::get_by_id($_id);

		if(!$result)
		{
			\dash\notif::error(T_("Detail not found"));
			return false;
		}

		return $result;
	}


	public static function get($_id, $_options = [])
	{
		$result = self::inline_get($_id);

		if($result)
		{
			$result = \lib\app\product\ready::row($result, $_options);
		}

		return $result;
	}
}
?>