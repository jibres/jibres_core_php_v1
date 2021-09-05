<?php
namespace lib\pagebuilder\tools;

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



	private static function default_code()
	{
		$list = self::list();

		if(!isset($_key) || !array_key_exists($_key, $list))
		{
			foreach ($list as $key => $item)
			{
				if(isset($item['default']) && $item['default'])
				{
					return $key;
				}
			}
		}

		return null;
	}



	public static function input_condition($input_condition)
	{
		$list = self::list();
		$input_condition[self::$variable_name] = ['enum' => array_keys($list)];
		$input_condition['set_'. self::$variable_name] = 'bit';

		return $input_condition;
	}


	public static function select_html($_current_data = null)
	{
		$result = '';

		$list = self::list();

		foreach ($list as $key => $value)
		{
			$result.= '<option value="'. $key. '"';
			if($key == $_current_data || (!$_current_data && $_current_data != '0' && $value['default']))
			{
				$result .= ' selected';
			}
			$result.= ' >';

			$result .= $value['title'];

			$result.= '</option>';
		}

		return $result;
	}



	public static function ready_for_db($_data)
	{
		$variable = [];

		if(!is_array($_data))
		{
			return $_data;
		}

		if(array_key_exists(self::$variable_name, $_data))
		{
			$variable['code'] = $_data[self::$variable_name];
			unset($_data[self::$variable_name]);
		}

		if(!empty($variable))
		{
			$variable = json_encode($variable, JSON_UNESCAPED_UNICODE);

			$_data[self::$variable_name] = $variable;
		}
		else
		{
			$_data[self::$variable_name] = null;
		}

		unset($_data['set_'. self::$variable_name]);

		return $_data;

	}


	public static function ready($_data)
	{
		if(isset($_data[self::$variable_name]) && (is_string($_data[self::$variable_name]) || is_numeric($_data[self::$variable_name])))
		{
			$variable = json_decode($_data[self::$variable_name], true);

			if(!is_array($variable))
			{
				$variable         = [];
				$variable['code'] = self::default_code(); // the default value
			}

			if(!a($variable, 'code') && a($variable, 'code') !== '0')
			{
				$variable['code'] = self::default_code();
			}


			$_data[self::$variable_name] = $variable;
		}
		else
		{
			$_data[self::$variable_name]['code'] = self::default_code();
		}

		return $_data;
	}
}
?>