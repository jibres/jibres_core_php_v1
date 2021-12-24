<?php
namespace lib\db\factordetails;


class update
{
	public static function record()
	{
		$result = \dash\pdo\query_template::update('factordetails', ...func_get_args());
		return $result;
	}
}
?>