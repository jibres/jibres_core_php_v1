<?php
namespace lib\pagebuilder\config;

class ratio
{
	use \lib\pagebuilder\config\enum_variable;

	public static $variable_name = 'ratio';

	public static function list()
	{

		$list           = \lib\ratio::list();

		return $list;

	}
}
?>