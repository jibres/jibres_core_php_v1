<?php
namespace lib\app\tax\year;


class get
{



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


	public static function startdate()
	{
		$get_last_end_date = \lib\db\tax_year\get::last_end_date();
		if($get_last_end_date)
		{
			$startdate = date("Y-m-d", strtotime($get_last_end_date) + (60*60*24));
		}

		return null;

	}

}
?>