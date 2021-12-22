<?php
namespace lib\db\giftlookup;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('giftlookup', $_args);
	}

}
?>
