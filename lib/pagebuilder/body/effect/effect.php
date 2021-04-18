<?php
namespace lib\pagebuilder\body\effect;


class effect
{
	use \lib\pagebuilder\tools\enum_variable;

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