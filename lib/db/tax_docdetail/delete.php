<?php
namespace lib\db\tax_docdetail;


class delete
{

	public static function by_id($_id)
	{
		$query  = "DELETE FROM tax_docdetail WHERE tax_docdetail.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;

	}

}
?>
