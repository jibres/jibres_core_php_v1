<?php
namespace lib\db\factoraction;


class update
{
	public static function record()
	{
		$result = \dash\pdo\query_template::update('factoraction', ...func_get_args());
		return $result;
	}
}
?>