<?php
namespace lib\db\form;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('form', $_args, $_id);
	}

}
?>
