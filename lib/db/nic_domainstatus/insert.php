<?php
namespace lib\db\nic_domainstatus;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('domainstatus', $_args, 'nic');
	}



	public static function multi_insert($_args)
	{
		return \dash\pdo\query_template::multi_insert('domainstatus', $_args, 'nic');
	}
}
?>
