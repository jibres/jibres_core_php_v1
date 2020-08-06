<?php
namespace lib\db\tax_document;


class delete
{

	public static function by_id($_id)
	{
		$query  = "DELETE FROM tax_document WHERE tax_document.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;

	}

}
?>
