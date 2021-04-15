<?php
namespace lib\app\pagebuilder\config;

trait enum_variable
{

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
		$variable = [];

		if(array_key_exists(self::$variable_name, $_data))
		{
			$variable['code'] = $_data[self::$variable_name];
		}

		if(!empty($variable))
		{
			$variable = json_encode($variable, JSON_UNESCAPED_UNICODE);

			$data[self::$variable_name] = $variable;
		}
		else
		{
			$data[self::$variable_name] = null;
		}

	}


	public static function ready(&$data)
	{
		if(isset($data[self::$variable_name]) && is_string($data[self::$variable_name]))
		{
			$variable = json_decode($data[self::$variable_name], true);

			if(!is_array($variable))
			{
				$variable = []; // the default value
			}


			$data[self::$variable_name] = $variable;
		}
	}
}
?>