<?php
namespace lib\pagebuilder\body\ratio;

class ratio
{
	use \lib\pagebuilder\tools\enum_variable;

	public static $variable_name = 'ratio';

	public static function list()
	{

		$list           = \lib\ratio::list();

		// set default ratio
		if(isset($list['1:1']))
		{
			$list['1:1']['default'] = true;
		}

		return $list;

	}
}
?>