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
}
?>