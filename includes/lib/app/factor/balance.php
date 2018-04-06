<?php
namespace lib\app\factor;

trait balance
{
	// save this query in this var to run multiquery
	private static $CHANGE_STATIC_QUERY = [];



	public static function stock_plus($_product_id, $_plus = 1, $_multi_query = false)
	{
		if(!$_product_id || !is_numeric($_product_id))
		{
			return false;
		}

		$_plus = floatval($_plus);

		return self::change_var_static($_product_id, 'stock', 'plus', $_plus, $_multi_query);
	}


	public static function stock_minus($_product_id, $_minus = 1, $_multi_query = false)
	{
		if(!$_product_id || !is_numeric($_product_id))
		{
			return false;
		}

		$_minus = floatval($_minus);

		return self::change_var_static($_product_id, 'stock', 'minus', $_minus, $_multi_query);
	}


	public static function sold_plus($_product_id, $_count = 1, $_multi_query = false)
	{
		if(!$_product_id || !is_numeric($_product_id))
		{
			return false;
		}

		$_count = floatval($_count);

		return self::change_var_static($_product_id, 'sold', 'plus', $_count, $_multi_query);
	}


	public static function sold_minus($_product_id, $_count = 1, $_multi_query = false)
	{
		if(!$_product_id || !is_numeric($_product_id))
		{
			return false;
		}

		$_count = floatval($_count);

		return self::change_var_static($_product_id, 'sold', 'minus', $_count, $_multi_query);
	}


	/**
	 * change some field by plus or minus var
	 *
	 * @param      <type>  $_product_id  The product identifier
	 * @param      <type>  $_field       The field [for example stock or sold]
	 * @param      string  $_type        The type [plus or minus]
	 * @param      <type>  $_count       The count [1,20,...]
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function change_var_static($_product_id, $_field, $_type, $_count, $_multi_query)
	{

		if($_type === 'plus')
		{
			$query = "UPDATE products SET products.$_field = IF(products.$_field = '' OR products.$_field IS NULL , $_count, products.$_field + $_count) WHERE products.id = $_product_id LIMIT 1";
		}
		elseif($_type === 'minus')
		{
			$query = "UPDATE products SET products.$_field = IF(products.$_field = '' OR products.$_field IS NULL , -$_count, products.$_field - $_count) WHERE products.id = $_product_id LIMIT 1";
		}
		else
		{
			return null;
		}

		if($_multi_query)
		{
			self::$CHANGE_STATIC_QUERY[] = $query;
		}
		else
		{
			return \dash\db::query($query);
		}
	}


	public static function change_var_static_multi_query()
	{
		$result = null;
		if(!empty(self::$CHANGE_STATIC_QUERY))
		{
			$query = implode(';', self::$CHANGE_STATIC_QUERY);
			$result = \dash\db::query($query, true, ['multi_query' => true]);
		}
		self::$CHANGE_STATIC_QUERY = [];
		return $result;
	}
}
?>
