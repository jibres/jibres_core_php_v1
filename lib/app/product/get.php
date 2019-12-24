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
			\dash\notif::error(T_("Product id not set"));
			return false;
		}

		if(!is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}


		if(isset(self::$product_detail[$_id]))
		{
			$result = self::$product_detail[$_id];
		}
		else
		{
			$result = \lib\db\products\get::by_id($_id);

			if(!$result)
			{
				\dash\notif::error(T_("Product detail not found"));
				return false;
			}

			self::$product_detail[$_id] = $result;
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


	/**
	 * Get some prodcut
	 *
	 * @param      <type>  $_ids      The identifiers
	 * @param      array   $_options  The options
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function multi_product($_ids, $_options = [])
	{
		$result = \lib\db\products\get::by_multi_id($_ids);

		if($result)
		{
			$result = array_map(['\\lib\\app\\product\\ready', 'row'], $result);
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

		$next_prev = \lib\db\products\get::next_prev($result['id']);

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