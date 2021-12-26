<?php
namespace lib\app\product;


class get
{
	private static $product_prev      = [];
	private static $product_next      = [];

	public static function sitemap_list($_from, $_to)
	{
		$list = \lib\db\products\get::sitemap_list($_from, $_to);
		if(!is_array($list))
		{
			return false;
		}

		$list = array_map(['\\lib\\app\\product\\ready', 'row_quick'], $list);

		return $list;
	}


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

		$result = \lib\db\products\get::by_id($_id);

		if(!$result)
		{
			\dash\notif::error(T_("Product detail not found"));
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


	public static function site($_id, $_options = [])
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

		$result = \lib\db\products\get::by_id_for_site($_id);

		if(!$result)
		{
			\dash\notif::error(T_("Product detail not found"));
			return false;
		}

		$result = \lib\app\product\ready::row($result, $_options);


		return $result;
	}



	public static function by_barcode($_barcode, $_options = [])
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		$_barcode = \dash\validate::barcode($_barcode);
		if(!$_barcode)
		{
			\dash\notif::error(T_("Product id not set"));
			return false;
		}

		$result = \lib\db\products\get::by_barcode_for_site($_barcode);


		if(!$result)
		{
			\dash\notif::error(T_("Product detail not found"));
			return false;
		}

		$result = \lib\app\product\ready::row($result, $_options);


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