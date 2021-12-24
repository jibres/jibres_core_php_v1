<?php
namespace lib\db\nic_dns;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('dns', $_args, 'nic');

	}
}
?>
