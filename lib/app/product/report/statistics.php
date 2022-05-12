<?php
namespace lib\app\product\report;


class statistics
{
	public static function count_all()
	{
		$result = \lib\db\products\get::count_all();
		if($result && is_numeric($result))
		{
			return floatval($result);
		}
		return 0;
	}


	public static function total_pricechange()
	{
		$result = \lib\db\productprices\get::count_all();
		if($result && is_numeric($result))
		{
			return floatval($result);
		}
		return 0;
	}


	public static function count_have_variants()
	{
		$result = \lib\db\products\get::count_have_variants();
		if($result && is_numeric($result))
		{
			return floatval($result);
		}
		return 0;
	}

	public static function total_fund()
	{
		$result = \lib\db\products\get::total_fund();

		if($result && is_array($result))
		{
			foreach ($result as $key => $value)
			{
				$result[$key] = floatval($value);
			}
			return $result;
		}
		return [];
	}



	public static function average_finalprice()
	{
		$result = \lib\db\products\get::average_finalprice();
		if($result && is_numeric($result))
		{
			return floatval($result);
		}
		return 0;
	}


	public static function tag_count()
	{
		$result = \lib\db\producttag\get::count_all();
		if($result && is_numeric($result))
		{
			return $result;
		}
		return 0;
	}


	public static function category_count()
	{
		$result = \lib\db\productcategory\get::count_all();
		if($result && is_numeric($result))
		{
			return $result;
		}
		return 0;
	}



	public static function unit_count()
	{
		$result = \lib\db\productunit\get::count_all();
		if($result && is_numeric($result))
		{
			return $result;
		}
		return 0;
	}


	public static function most_product_in_cart()
	{
		$result = \lib\db\products\get::most_product_in_cart();
		$result = \lib\app\product\ready::row($result);
		return $result;
	}


	public static function bestselling()
	{
		$result = \lib\db\products\get::bestselling();
		$result = \lib\app\product\ready::row($result);
		return $result;
	}

	public static function max_price_change_count()
	{
		$result = \lib\db\products\get::max_price_change_count();
		$result = \lib\app\product\ready::row($result);
		return $result;
	}


	public static function expensive()
	{
		// $result = \lib\report\cache::get(['\\lib\\db\\products\\get', 'expensive']);
		$result = \lib\db\products\get::expensive();
		$result = \lib\app\product\ready::row($result);
		return $result;
	}

	public static function inexpensive()
	{
		$result = \lib\db\products\get::inexpensive();
		$result = \lib\app\product\ready::row($result);
		return $result;
	}


	public static function expensive_list($_limit = null)
	{
		$limit = 5;
		$_limit = \dash\validate::smallint($_limit, false);
		if($_limit)
		{
			if(floatval(abs($_limit)) < 50)
			{
				$limit = abs($_limit);
			}
		}
		$result = \lib\db\products\get::expensive_list($limit);
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\product\\ready', 'row'], $result);
		return $result;
	}


	public static function inexpensive_list($_limit = null)
	{
		$limit = 5;
		$_limit = \dash\validate::smallint($_limit, false);
		if($_limit)
		{
			if(floatval(abs($_limit)) < 50)
			{
				$limit = abs($_limit);
			}
		}
		$result = \lib\db\products\get::inexpensive_list($limit);
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\product\\ready', 'row'], $result);
		return $result;
	}




	public static function maxsale()
	{
		$result = \lib\db\products\get::maxsale();
		$result = \lib\app\product\ready::row($result);
		return $result;
	}




	public static function maxsale_list($_limit = null)
	{
		$limit = 5;
		$_limit = \dash\validate::smallint($_limit, false);
		if($_limit)
		{
			if(floatval(abs($_limit)) < 50)
			{
				$limit = abs($_limit);
			}
		}
		$result = \lib\db\products\get::maxsale_list($limit);
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\product\\ready', 'row'], $result);
		return $result;
	}




	public static function maxsaleprice()
	{
		$result = \lib\db\products\get::maxsaleprice();
		$result = \lib\app\product\ready::row($result);
		return $result;
	}




	public static function maxsaleprice_list($_limit = null)
	{
		$limit = 5;
		$_limit = \dash\validate::smallint($_limit, false);
		if($_limit)
		{
			if(floatval(abs($_limit)) < 50)
			{
				$limit = abs($_limit);
			}
		}
		$result = \lib\db\products\get::maxsaleprice_list($limit);
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\product\\ready', 'row'], $result);
		return $result;
	}


	public static function maxstock()
	{
		$result = \lib\db\products\get::maxstock();
		$result = \lib\app\product\ready::row($result);
		return $result;
	}



	public static function maxstock_list($_limit = null)
	{
		$limit = 5;
		$_limit = \dash\validate::smallint($_limit, false);
		if($_limit)
		{
			if(floatval(abs($_limit)) < 50)
			{
				$limit = abs($_limit);
			}
		}
		$result = \lib\db\products\get::maxstock_list($limit);
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\product\\ready', 'row'], $result);
		return $result;
	}



	public static function last_product_in_cart($_limit = null)
	{
		$limit = 5;
		$_limit = \dash\validate::smallint($_limit, false);
		if($_limit)
		{
			if(floatval(abs($_limit)) < 50)
			{
				$limit = abs($_limit);
			}
		}
		$result = \lib\db\products\get::last_product_in_cart($limit);
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\product\\ready', 'row'], $result);
		return $result;
	}



}
?>