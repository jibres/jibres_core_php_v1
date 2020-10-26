<?php
namespace dash\db\mysql\tools;

class pagination
{
	/**
	 * get pagination
	 *
	 * @param      <type>  $_total_rows   The query
	 * @param      <type>  $_length  The length
	 *
	 * @return     <type>  array [startlimit, endlimit]
	 */
	public static function pagination($_total_rows, $_length)
	{
		return \dash\utility\pagination::init($_total_rows, $_length);
	}

	public static function pagination_fake($_fake_total_row, $_length = 10)
	{

		$total_rows = floatval($_fake_total_row);
		$result     = self::pagination($total_rows, $_length);

		if($result)
		{
			return "LIMIT ". implode(',', $result);
		}
		else
		{
			return null;
		}
	}



	public static function pagination_query($_query, $_length = 10, $_fuel = null)
	{
		$total_rows = \dash\db::get($_query, 'count', true, $_fuel);
		$total_rows = floatval($total_rows);
		$result     = self::pagination($total_rows, $_length);

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
