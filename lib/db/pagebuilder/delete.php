<?php
namespace lib\db\pagebuilder;


class delete
{

	public static function by_id(int $_id)
	{
		$query  = "DELETE FROM pagebuilder WHERE pagebuilder.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>
