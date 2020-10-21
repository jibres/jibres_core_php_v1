<?php
namespace lib\app\website\body;

class get
{
	private static $loaded = [];


	public static function get_sort_body_line($_all = false)
	{
		$sort = \lib\db\setting\get::platform_cat_key('website', 'body', 'sort_line');

		if(isset($sort['value']))
		{
			$sort = json_decode($sort['value'], true);
		}
		else
		{
			$sort = [];
		}

		if(!is_array($sort))
		{
			$sort = [];
		}

		$sort = array_map('floatval', $sort);
		$sort = array_filter($sort);
		$sort = array_unique($sort);

		if($_all)
		{
			$load_line = \lib\db\setting\get::get_website_all($sort);
		}
		else
		{
			$load_line = \lib\db\setting\get::get_body_line($sort);
		}

		return $load_line;

	}


	public static function line_list($_raw = false)
	{
		$load_line = self::$loaded;

		if(!$load_line)
		{
			$load_line = self::get_sort_body_line();
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

		$setting = \lib\db\setting\get::platform_cat_id('website', 'homepage', $id);

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
		$have_any_slider = \lib\db\setting\get::platform_cat_multi_key('website', 'homepage', ['body_line_specialslider','body_line_slider']);
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