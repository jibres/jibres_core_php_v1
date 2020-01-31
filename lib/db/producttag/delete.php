<?php
namespace lib\db\producttag;


class delete
{
	public static function record($_id)
	{
		$query = "DELETE FROM producttag WHERE producttag.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>