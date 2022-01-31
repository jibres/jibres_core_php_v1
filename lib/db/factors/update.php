<?php
namespace lib\db\factors;


class update
{
	public static function record($_args, $_id)
	{
		unset($_args['payable']);
		$result = \dash\pdo\query_template::update('factors', $_args, $_id);
		return $result;
	}
}
?>