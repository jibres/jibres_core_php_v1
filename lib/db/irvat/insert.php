<?php
namespace lib\db\irvat;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('ir_vat', $_args);

	}
}
?>