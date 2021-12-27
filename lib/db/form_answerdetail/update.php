<?php
namespace lib\db\form_answerdetail;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('form_answerdetail', $_args, $_id);
	}

}
?>
