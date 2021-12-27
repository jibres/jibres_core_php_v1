<?php
namespace lib\db\form_view;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('form_view', $_args, $_id);
	}

}
?>
