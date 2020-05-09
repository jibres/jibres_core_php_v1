<?php
namespace lib\app\website\body;

class get
{

	public static function line_list()
	{

		$load_line = \lib\db\setting\get::platform_cat_key('website', 'body', 'sort_list');


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

			$line_detail = \lib\app\website\body\line::list();
			$line_detail = array_combine(array_column($line_detail, 'key'), $line_detail);


			$result = [];
			foreach ($value as $index => $saved_line_detail)
			{
				$result[$index] = $saved_line_detail;
				if(isset($saved_line_detail['type']) && isset($line_detail[$saved_line_detail['type']]))
				{
					$result[$index] = array_merge($saved_line_detail, $line_detail[$saved_line_detail['type']]);
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
			if(isset($value['line_key']) && isset($value['type']) && $value['line_key'] === $line_key)
			{
				$line_type = $value['type'];
				break;
			}
		}

		if(!$line_type)
		{
			return false;
		}

		$option = \lib\app\website\body\line::get($line_type);

		if(!$option)
		{
			return false;
		}


		return $option;
	}
}
?>