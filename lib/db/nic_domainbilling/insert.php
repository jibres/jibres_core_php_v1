<?php
namespace lib\db\nic_domainbilling;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('domainbilling', $_args, 'nic');

	}
}
?>
