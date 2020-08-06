<?php
namespace lib\db\tax_coding;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function parent_list()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.parent3 IS NULL";
		$result = \dash\db::get($query);
		return $result;
	}

}
?>
