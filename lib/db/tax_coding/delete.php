<?php
namespace lib\db\tax_coding;


class delete
{

	public static function by_id($_id)
	{
		$query  = "DELETE FROM tax_coding WHERE tax_coding.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;

	}

}
?>
