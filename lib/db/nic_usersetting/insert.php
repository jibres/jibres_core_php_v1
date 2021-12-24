<?php
namespace lib\db\nic_usersetting;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('usersetting', $_args, 'nic');
	}
}
?>
