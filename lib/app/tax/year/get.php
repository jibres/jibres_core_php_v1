<?php
namespace lib\app\tax\year;


class get
{
	public static function list()
	{
		$list = \lib\db\tax_year\get::all();
		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\tax\\year\\ready', 'row'], $list);
		return $list;
	}

	private static $default_year = [];

	public static function default_year($_need = null)
	{
		if(!self::$default_year)
		{
			$load = \lib\db\tax_year\get::default_year();
			self::$default_year = $load;
		}

		$load = self::$default_year;

		if(isset($load['id']))
		{
			if($_need)
			{
				if(array_key_exists($_need, $load))
				{
					return $load[$_need];
				}
				else
				{
					return null;
				}
			}
			else
			{
				return $load;
			}
		}
		return null;
	}


	public static function get($_id)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$result = \lib\db\tax_year\get::by_id($id);

		if(!$result)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$result = \lib\app\tax\year\ready::row($result);
		return $result;
	}


	private static $startdate = null;
	public static function startdate()
	{
		if(!self::$startdate)
		{
			$get_last_end_date = \lib\db\tax_year\get::last_end_date();
			if($get_last_end_date)
			{
				$startdate = date("Y-m-d", strtotime($get_last_end_date) + (60*60*24));
				self::$startdate = $startdate;
			}
		}

		return self::$startdate;
	}

	public static function enddate()
	{
		$startdate = self::startdate();
		if($startdate)
		{
			$enddate = date("Y-m-d", strtotime($startdate) + (60*60*24*365));
			return $enddate;
		}
		return null;
	}

}
?>