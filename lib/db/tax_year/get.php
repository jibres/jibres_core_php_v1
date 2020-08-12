<?php
namespace lib\db\tax_year;


class get
{
	public static function last_end_date()
	{
		$query = "SELECT MAX(tax_year.enddate) AS `enddate` FROM tax_year ";
		$result = \dash\db::get($query, 'enddate', true);
		return $result;
	}


	public static function check_duplicate_title($_title)
	{
		$query = "SELECT * FROM tax_year WHERE tax_year.title = '$_title' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}




	public static function by_id($_id)
	{
		$query = "SELECT * FROM tax_year WHERE tax_year.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}






}
?>
