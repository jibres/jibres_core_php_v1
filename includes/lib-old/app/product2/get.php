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

		$result = \lib\db\products2\db::get_by_id($id, \lib\store::id());

		if(!$result)
		{
			\dash\notif::error(T_("Detail not found"));
			return false;
		}

		return $result;
	}


	public static function by_code_inline($_code)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!$_code)
		{
			\dash\notif::error(T_("Code not set"));
			return false;
		}


		if(!is_numeric($_code))
		{
			\dash\notif::error(T_("Invalid code"));
			return false;
		}

		$result = \lib\db\products2\db::get_by_code($_code, \lib\store::id());

		if(!$result)
		{
			\dash\notif::error(T_("Detail not found"));
			return false;
		}


		return $result;
	}


	public static function by_code($_code, $_options = [])
	{
		$result = self::by_code_inline($_code);
		if($result)
		{
			$result = \lib\app\product2\ready::row($result, $_options);
		}
		return $result;
	}


	public static function get($_id, $_options = [])
	{
		$result = self::inline_get($_id);

		if($result)
		{
			$result = \lib\app\product2\ready::row($result, $_options);
		}

		return $result;
	}
}
?>