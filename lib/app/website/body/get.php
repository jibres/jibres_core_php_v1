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
			$load_line = \lib\db\setting\get::platform_cat_key('website', 'body', 'sort_list');
			self::$loaded = $load_line;
		}



		if(!isset($load_line['id']) || !isset($load_line['value']))
		{
			return [];
		}
		else
		{
			$value = json_decode($load_line['value'], true);

			if(!is_array($value))
			{
				$value = [];
			}

			if($_raw)
			{
				return $value;
			}

			$line_detail = \lib\app\website\body\line::list();

			$line_detail = array_combine(array_column($line_detail, 'key'), $line_detail);

			$result = [];
			foreach ($value as $index => $saved_line_detail)
			{
				if(isset($saved_line_detail['type']) && isset($line_detail[$saved_line_detail['type']]))
				{

					$result[$index] = \lib\app\website\body\line::get($saved_line_detail['type']);
					$result[$index]['saved_detail'] = $saved_line_detail;
				}
			}

			return $result;
		}

	}



	public static function line_option($_line_key)
	{
		$line_key = \dash\validate::md5($_line_key);

		if(!$line_key)
		{
			return false;
		}

		$line_type = null;

		$line_list = self::line_list();

		foreach ($line_list as $key => $value)
		{
			if(isset($value['saved_detail']['line_key']) && $value['saved_detail']['line_key'] === $line_key)
			{
				$line_type = $value;
				break;
			}
		}

		if(!$line_type)
		{
			return false;
		}

		return $line_type;
	}
}
?>