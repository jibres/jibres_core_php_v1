<?php
namespace lib\db\store_plan_history;


class update
{

	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('store_plan_history', $_args, $_id, 'master');

	}
}
?>
