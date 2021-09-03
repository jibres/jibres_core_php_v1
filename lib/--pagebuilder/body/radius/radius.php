<?php
namespace lib\pagebuilder\body\radius;

class radius
{
	use \lib\pagebuilder\tools\enum_variable;

	public static $variable_name = 'radius';

	public static function list()
	{

		$list           = [];
		$list['0']      = ['title' => "0", 'default' => false];
		$list['1x']     = ['title' => "1x", 'default' => true];
		$list['2x']     = ['title' => "2x", 'default' => false];
		$list['3x']     = ['title' => "3x", 'default' => false];
		$list['4x']     = ['title' => "4x", 'default' => false];
		$list['circle'] = ['title' => T_("Circle"), 'default' => false];

		return $list;

	}
}
?>