<?php
namespace lib\app\product2;


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

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$result = \lib\db\products::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(!$result)
		{
			\dash\notif::error(T_("Detail not found"));
			return false;
		}

		return $result;
	}



	public static function get($_id)
	{
		$result = self::inline_get($_id);

		if($result)
		{
			$result = self::ready($result);
		}

		return $result;
	}
}
?>