<?php
namespace dash\db;

class pagination
{

	public static function pagination_query($_query, $_param, $_length = 10, $_fuel = null)
	{
		$total_rows = \dash\pdo::get($_query, $_param, 'count', true, $_fuel);
		$total_rows = floatval($total_rows);
		$result     = \dash\utility\pagination::init($total_rows, $_length);

		if($result)
		{
			return "LIMIT ". implode(',', $result);
		}
		else
		{
			return null;
		}
	}
}
?>
