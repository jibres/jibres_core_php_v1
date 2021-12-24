<?php
namespace lib\db\nic_domainaction;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('domainaction', $_args, 'nic');
	}
}
?>
