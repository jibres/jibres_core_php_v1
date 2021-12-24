<?php
namespace lib\db\inventory;


class update
{
	public static function record()
	{
		$result = \dash\pdo\query_template::update('inventory', ...func_get_args());
		return $result;
	}


}
?>