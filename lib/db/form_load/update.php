<?php
namespace lib\db\form_load;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('form_load', $_args, $_id);
	}



}

