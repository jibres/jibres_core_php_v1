<?php
namespace lib\db\form_view;


class delete
{


	public static function view_table($_table_name)
	{
		$query  = " DROP TABLE IF EXISTS `$_table_name` ";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
