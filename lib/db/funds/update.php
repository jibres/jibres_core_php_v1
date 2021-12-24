<?php
namespace lib\db\funds;


class update
{
	public static function record()
	{
		$result = \dash\pdo\query_template::update('funds', ...func_get_args());
		return $result;
	}
}
?>