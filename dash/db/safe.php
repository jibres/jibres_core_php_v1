<?php
namespace dash\db;


class safe
{
	public static function value($_value)
	{
		// if(\dash\db::$link && is_string($_value))
		// {
		// 	$_value = \mysqli_real_escape_string(\dash\db::$link, $_value);
		// }
		$_value = \dash\safe::safe($_value);
		return $_value;
	}
}
?>
