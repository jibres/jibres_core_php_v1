<?php
namespace lib\db\tax_year;


class delete
{

	public static function by_id($_id)
	{
		$query  = "DELETE FROM tax_year WHERE tax_year.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;

	}

}
?>
