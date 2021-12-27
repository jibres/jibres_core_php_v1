<?php
namespace lib\db\form_answer;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('form_answer', $_args, $_id);
	}

}
?>
