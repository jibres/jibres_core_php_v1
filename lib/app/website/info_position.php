<?php
namespace lib\app\website;

class info_position
{
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


	public static function get($_key)
	{
		$list = self::list();

		if(!isset($_key) || !array_key_exists($_key, $list))
		{
			foreach ($list as $key => $item)
			{
				if(isset($item['default']) && $item['default'])
				{
					$_key = $key;
				}
			}
		}

		return $_key;
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