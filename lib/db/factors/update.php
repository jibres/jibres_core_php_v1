<?php
namespace lib\db\factors;


class update
{
	public static function record()
	{
		$result = \dash\pdo\query_template::update('factors', ...func_get_args());
		return $result;
	}
}
?>