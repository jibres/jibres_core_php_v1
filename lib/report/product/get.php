<?php
namespace lib\report\product;


class get
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


	public static function average_finalprice()
	{
		$result = \lib\db\products\get::average_finalprice();
		if($result && is_numeric($result))
		{
			return \lib\price::down($result);
		}
		return 0;
	}




	public static function expensive()
	{
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

}
?>