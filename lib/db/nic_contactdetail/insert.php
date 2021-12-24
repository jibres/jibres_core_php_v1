<?php
namespace lib\db\nic_contactdetail;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('contactdetail', $_args, 'nic');
	}
}
?>
