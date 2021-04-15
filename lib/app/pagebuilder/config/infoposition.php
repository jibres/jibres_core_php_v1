<?php
namespace lib\app\pagebuilder\config;


class infoposition
{
	use \lib\app\pagebuilder\config\enum_variable;

	public static $variable_name = 'infoposition';


	public static function list()
	{
		$list           = [];
		$list['none']   = ['title' => T_("none"), 'default' => false,];
		$list['top']    = ['title' => T_("top"), 'default' => false,];
		$list['bottom'] = ['title' => T_("bottom"), 'default' => false,];
		$list['beside'] = ['title' => T_("beside"), 'default' => false,];
		$list['inside'] = ['title' => T_("inside"), 'default' => true,];
		return $list;

	}

}
?>