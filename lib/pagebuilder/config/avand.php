<?php
namespace lib\pagebuilder\config;


class avand
{
	use \lib\pagebuilder\config\enum_variable;

	public static $variable_name = 'avand';

	public static function list()
	{

		$list           = [];
		$list["avand"]     = ['title' => T_("Container"), 'default' => true,];
		$list["avand-sm"]  = ['title' => T_("Small"), 'default' => false,];
		$list["avand-md"]  = ['title' => T_("Medium"), 'default' => false,];
		$list["avand-lg"]  = ['title' => T_("Large"), 'default' => false,];
		$list["avand-xl"]  = ['title' => T_("X Large"), 'default' => false,];
		$list["avand-xxl"] = ['title' => T_("XX Large"), 'default' => false,];
		$list["none"]      = ['title' => T_("Without container"), 'default' => false,];

		return $list;

	}

}
?>