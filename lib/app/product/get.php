<?php
namespace lib\app\product;


class get
{
	private static $product_detail    = [];
	private static $product_prev      = [];
	private static $product_next      = [];



	public static function first_sale($_id)
	{
		if($_id && is_numeric($_id))
		{
			$result = \lib\db\factordetails\get::first_sale($_id);
			if($result)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		return null;
	}

	public static function inline_get($_id)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		$_id = \dash\validate::id($_id);
		if(!$_id)
		{
			\dash\notif::error(T_("Product id not set"));
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
		$result = \lib\db\products\get::by_multi_id(implode(',', $_ids));

		if($result)
		{
			$result = array_map(['\\lib\\app\\product\\ready', 'row'], $result);
		}

		return $result;
	}





	public static function next($_id, $_raw = false)
	{
		if(isset(self::$product_next[$_id]))
		{
			return self::$product_next[$_id];
		}

		$result = self::inline_get($_id);

		if(!$result)
		{
			return false;
		}

		$next = \lib\db\products\get::next($result['id']);

		if(!$next)
		{
			$next = \lib\db\products\get::first_product_id();
		}

		if(!$_raw)
		{
			$next = \dash\url::this(). '/edit?id='. $next;
		}

		self::$product_next[$_id] = $next;

		return $next;
	}


	public static function prev($_id, $_raw = false)
	{
		if(isset(self::$product_prev[$_id]))
		{
			return self::$product_prev[$_id];
		}

		$result = self::inline_get($_id);

		if(!$result)
		{
			return false;
		}

		$prev = \lib\db\products\get::prev($result['id']);

		if(!$prev)
		{
			$prev = \lib\db\products\get::end_product_id();
		}

		if(!$_raw)
		{
			$prev = \dash\url::this(). '/edit?id='. $prev;
		}

		self::$product_prev[$_id] = $prev;

		return $prev;
	}




}
?>