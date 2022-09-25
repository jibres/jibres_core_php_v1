<?php
namespace lib\db\form_load;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('form_load', $_args);
	}


}
