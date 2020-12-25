<?php
namespace lib\app\website;

class radius
{
	public static function list()
	{

		$list             = [];
		$list["normal"]   = ['title' => T_("Normal"), 'default' => true,];
		$list["sharp"]    = ['title' => T_("Sharp"), 'default' => true,];
		$list["circular"] = ['title' => T_("Circular"), 'default' => true,];
		$list["none"]     = ['title' => T_("None"), 'default' => false,];

		return $list;

	}


	public static function input_check()
	{
		$list = self::list();
		return ['enum' => array_keys($list)];
	}


	public static function select_html($_current_data = null)
	{
		$result = '';

		$list = self::list();

		foreach ($list as $key => $value)
		{
			$result.= '<option value="'. $key. '"';
			if($key == $_current_data || (!$_current_data && $value['default']))
			{
				$result .= ' selected';
			}
			$result.= ' >';

			$result .= $value['title'];

			$result.= '</option>';
		}

		return $result;
	}
}
?>