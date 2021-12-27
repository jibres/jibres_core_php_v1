<?php
namespace dash\db\terms;

class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('terms', $_args, $_id);
	}

}
?>