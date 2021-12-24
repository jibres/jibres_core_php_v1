<?php
namespace lib\db\nic_credit;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('credit', $_args, 'nic');
	}

	public static function multi_insert($_args)
	{
		return \dash\pdo\query_template::multi_insert('credit', $_args, 'nic');
	}
}
?>
