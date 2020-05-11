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
			$load_line = \lib\db\setting\get::platform_cat_key('website', 'homepage', 'body_line_list');
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

			$line_detail = \lib\app\website\body\template::list();

			$line_detail = array_combine(array_column($line_detail, 'key'), $line_detail);

			$result = [];
			foreach ($value as $index => $saved_line_detail)
			{
				if(isset($saved_line_detail['type']) && isset($line_detail[$saved_line_detail['type']]))
				{

					$result[$index] = \lib\app\website\body\template::get($saved_line_detail['type']);
					$result[$index]['saved_detail'] = $saved_line_detail;
				}
			}

			return $result;
		}

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
}
?>