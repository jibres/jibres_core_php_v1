<?php
namespace lib\app\website\body;

class get
{
	private static $loaded = [];

	public static function line_list($_raw = false)
	{
		$load_line = self::$loaded;

		if(!$load_line)
		{
			$load_line = \lib\db\setting\get::lang_platform_cat_key_like(\dash\language::current(), 'website', 'homepage', 'body_line%');
			self::$loaded = $load_line;
		}

		if(!$load_line || !is_array($load_line))
		{
			$load_line = [];
		}

		$result = [];

		foreach ($load_line as $key => $value)
		{
			if(isset($value['value']))
			{
				$my_value = json_decode($value['value'], true);
				if(isset($value['id']))
				{
					$my_value['id'] = \dash\coding::encode($value['id']);
				}

				if(isset($my_value['type']) && isset($my_value[$my_value['type']]) && is_array($my_value[$my_value['type']]))
				{
					$fn = ['\\lib\\app\\website\\body\\line\\'. $my_value['type'], 'ready'];
					if(is_callable($fn))
					{
						$my_value[$my_value['type']] = array_map($fn, $my_value[$my_value['type']]);
					}
				}

				$result[] = $my_value;
			}
		}


		return $result;
	}



	public static function line_setting($_id)
	{
		$id = \dash\validate::code($_id);

		if(!$id)
		{
			return false;
		}

		$id = \dash\coding::decode($id);

		$setting = \lib\db\setting\get::lang_platform_cat_id(\dash\language::current(), 'website', 'homepage', $id);

		$result = [];

		if(isset($setting['value']))
		{
			$result = json_decode($setting['value'], true);
		}

		if(!is_array($result))
		{
			$result = [];
		}


		return $result;
	}



	public static function have_any_slider()
	{
		$have_any_slider = \lib\db\setting\get::lang_platform_cat_multi_key(\dash\language::current(), 'website', 'homepage', ['body_line_specialslider','body_line_slider']);
		if($have_any_slider)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>