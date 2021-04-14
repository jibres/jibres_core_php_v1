<?php
namespace lib\app\pagebuilder\config;


class avand
{
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


	public static function input_condition()
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


	public static function ready_for_save_db(&$data, $_data)
	{
		$avand = [];

		if(array_key_exists('code', $_data))
		{
			$avand['code'] = $_data['code'];
		}

		if(!empty($avand))
		{
			$avand = json_encode($avand, JSON_UNESCAPED_UNICODE);

			$data['avand'] = $avand;
		}
		else
		{
			$data['avand'] = null;
		}

	}


	public static function ready(&$data)
	{
		if(isset($data['avand']) && is_string($data['avand']))
		{
			$avand = json_decode($data['avand'], true);

			if(!is_array($avand))
			{
				$avand = []; // the default value
			}


			$data['avand'] = $avand;
		}
	}
}
?>