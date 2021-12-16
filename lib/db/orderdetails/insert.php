<?php
namespace lib\db\orderdetails;

class insert
{
	public static function multi_insert($_args)
	{
		return \dash\pdo\query_template::multi_insert('factordetails', $_args);
	}
}
?>