<?php
namespace lib\app\tax\doc;


class report
{

	public static function detail_report($_year_id)
	{

		$year_id = \dash\validate::id($_year_id);
		if($year_id)
		{
			$load_year = \lib\app\tax\year\get::get($year_id);
			if(!isset($load_year['id']))
			{
				$year_id = null;
			}
		}

		$result = \lib\db\tax_document\get::detail_report($year_id);
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $result);
		return $result;


	}

}
?>