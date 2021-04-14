<?php
namespace lib\db\pagebuilder;


class get
{

	public static function by_id(int $_id)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_related(string $_id)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.related = '$_id' ORDER BY pagebuilder.sort ASC, pagebuilder.id ASC LIMIT 1000";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>
