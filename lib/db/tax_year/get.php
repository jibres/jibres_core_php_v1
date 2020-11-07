<?php
namespace lib\db\tax_year;


class get
{

	public static function last_year($_year_id)
	{
		$query =
		"
			SELECT
				LASTYEAR.*
			FROM
				tax_year AS `LASTYEAR`
			WHERE
				DATE(LASTYEAR.enddate) <= DATE((SELECT tax_year.startdate FROM tax_year WHERE tax_year.id = $_year_id ))
			ORDER BY LASTYEAR.enddate DESC
			LIMIT 1

		";

		$result = \dash\db::get($query, null, true);

		return $result;
	}


	public static function last_end_date()
	{
		$query = "SELECT MAX(tax_year.enddate) AS `enddate` FROM tax_year ";
		$result = \dash\db::get($query, 'enddate', true);
		return $result;
	}


	public static function default_year()
	{
		$query = "SELECT * FROM tax_year WHERE tax_year.isdefault = 1 LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function check_duplicate_title($_title)
	{
		$query = "SELECT * FROM tax_year WHERE tax_year.title = '$_title' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function not_use_in_docdetail($_year_id)
	{
		$query = "SELECT * FROM tax_docdetail WHERE tax_docdetail.year_id = '$_year_id' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_id($_id)
	{
		$query = "SELECT * FROM tax_year WHERE tax_year.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function all()
	{
		$query = "SELECT * FROM tax_year WHERE 1";
		$result = \dash\db::get($query);
		return $result;
	}




}
?>
