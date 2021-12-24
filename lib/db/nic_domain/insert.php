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
		$set = \dash\db\config::make_multi_insert($_args);
		if($set)
		{
			$query = " INSERT INTO `domain` $set ";
			return \dash\pdo::query($query, [], 'nic');
		}
	}
}
?>
