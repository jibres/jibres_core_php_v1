<?php
namespace lib\app\website_body;

class get
{

	public static function line_list()
	{

		$load_line = \lib\db\setting\get::platform_cat_key('website', 'lines', 'list');

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

			$line_detail = \lib\app\website_body\line::list();
			$line_detail = array_combine(array_column($line_detail, 'key'), $line_detail);

			$result = [];
			foreach ($value as $index => $line_key)
			{
				$result[$index] = $line_key;

				if(isset($line_detail[$line_key]))
				{
					$result[$index] = $line_detail[$line_key];
				}
			}

			return $result;
		}

	}
}
?>