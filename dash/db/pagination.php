<?php
namespace dash\db;

/**
 * This class describes an pagination.
 *
 * @author Reza
 *
 * All functions in this class became query bind PDO
 * @date 2021-12-30 16:04:49
 *
 */
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