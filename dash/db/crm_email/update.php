<?php
namespace dasg\db\crm_email;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('crm_email', $_args, $_id);
	}

}
?>
