<?php
namespace dash\db\transactions;


class update
{

	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('transactions', $_args, $_id);
	}
}
?>