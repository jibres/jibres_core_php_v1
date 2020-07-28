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


	public static function expensive_list()
	{
		$result = \lib\db\products\get::expensive_list(5);
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\product\\ready', 'row'], $result);
		return $result;
	}


	public static function inexpensive_list()
	{
		$result = \lib\db\products\get::inexpensive_list(5);
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




	public static function maxsale_list()
	{
		$result = \lib\db\products\get::maxsale_list(5);
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




	public static function maxsaleprice_list()
	{
		$result = \lib\db\products\get::maxsaleprice_list(5);
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\product\\ready', 'row'], $result);
		return $result;
	}

}
?>