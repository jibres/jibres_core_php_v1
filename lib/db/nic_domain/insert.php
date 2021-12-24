<?php
namespace lib\db\nic_domain;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('domain', $_args, 'nic');
	}


	public static function multi_insert($_args)
	{
		return \dash\pdo\query_template::multi_insert('domain', $_args, 'nic');
	}
}
?>
