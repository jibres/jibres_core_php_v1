<?php
namespace lib\db\app_download;

class insert
{

	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('app_download', $_args);
	}
}
?>