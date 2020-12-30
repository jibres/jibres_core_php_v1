<?php
namespace lib\app\website;

class radius
{
	public static function list()
	{

		$list           = [];
		$list['0']      = ['title' => "0", 'default' => false];
		$list['1x']     = ['title' => "1x", 'default' => false];
		$list['2x']     = ['title' => "2x", 'default' => false];
		$list['3x']     = ['title' => "3x", 'default' => false];
		$list['4x']     = ['title' => "4x", 'default' => false];
		$list['circle'] = ['title' => T_("Circle"), 'default' => false];

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