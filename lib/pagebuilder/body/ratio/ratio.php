<?php
namespace lib\pagebuilder\body\ratio;

class ratio
{
	use \lib\pagebuilder\tools\enum_variable;

	public static $variable_name = 'ratio';

	public static function list()
	{

		$list           = \lib\ratio::list();

		return $list;

	}
}
?>