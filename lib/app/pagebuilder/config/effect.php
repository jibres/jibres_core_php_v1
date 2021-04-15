<?php
namespace lib\app\pagebuilder\config;


class effect
{
	use \lib\app\pagebuilder\config\enum_variable;

	public static $variable_name = 'effect';

	public static function list()
	{

		$list                = [];
		$list["none"]        = ['title' => T_("None"), 'default' => false,];
		$list["zoom"]        = ['title' => T_("Zoom"), 'default' => true,];
		$list["darkShadow"]  = ['title' => T_("Dark Shadow"), 'default' => false,];
		$list["whiteShadow"] = ['title' => T_("White Shadow"), 'default' => false,];

		return $list;

	}
}
?>