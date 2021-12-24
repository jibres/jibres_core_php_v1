<?php
namespace lib\db\nic_poll;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('poll', $_args, 'nic');
	}
}
?>
