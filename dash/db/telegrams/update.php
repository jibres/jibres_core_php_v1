<?php
namespace dash\db\telegrams;


class update
{
	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('telegrams', $_args, $_id);
	}
}
?>