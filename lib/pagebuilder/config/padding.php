<?php
namespace lib\pagebuilder\config;


class padding
{
	use \lib\pagebuilder\config\enum_variable;

	public static $variable_name = 'padding';

	public static function list()
	{

		$list           = [];
		$list["zero"]   = ['title' => T_("Zero"), 'default' => false,];
		$list["normal"] = ['title' => T_("Normal"), 'default' => true,];
		$list["high"]   = ['title' => T_("High"), 'default' => false,];
		$list["extra"]  = ['title' => T_("Extra"), 'default' => false,];
		return $list;

	}
}
?>