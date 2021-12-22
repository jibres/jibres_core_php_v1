<?php
namespace lib\db\nic_contact;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('contact', $_args, 'nic');
	}
}
?>
