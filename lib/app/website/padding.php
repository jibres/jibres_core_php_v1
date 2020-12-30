<?php
namespace lib\app\website;

class padding
{
	public static function list()
	{

		$list           = [];
		$list["zero"]   = ['title' => T_("Zero"), 'default' => false,];
		$list["normal"] = ['title' => T_("Normal"), 'default' => true,];
		$list["high"]   = ['title' => T_("High"), 'default' => false,];
		$list["extra"]  = ['title' => T_("Extra"), 'default' => false,];
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