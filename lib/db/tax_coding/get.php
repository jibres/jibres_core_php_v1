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

}
?>
