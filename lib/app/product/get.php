<?php
namespace lib\app\product;


class get
{
	private static $product_detail    = [];
	private static $product_next_prev = [];


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

		if(!self::$product_detail)
		{
			$result = \lib\db\products\db::get_by_id($_id);

			if(!$result)
			{
				\dash\notif::error(T_("Detail not found"));
				return false;
			}

			self::$product_detail = $result;
		}

		return self::$product_detail;
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


	public static function next_prev($_id)
	{
		if(isset(self::$product_next_prev[$_id]))
		{
			return self::$product_next_prev[$_id];
		}

		$result = self::inline_get($_id);

		if(!$result)
		{
			return false;
		}

		$next_prev = \lib\db\products\db::get_next_prev($result['id']);

		$result = [];
		if(isset($next_prev['next']) && $next_prev['next'])
		{
			$result['next'] = \dash\url::this(). '/edit?id='. $next_prev['next'];
		}

		if(isset($next_prev['prev']) && $next_prev['prev'])
		{
			$result['prev'] = \dash\url::this(). '/edit?id='. $next_prev['prev'];
		}

		self::$product_next_prev[$_id] = $result;

		return $result;
	}
}
?>