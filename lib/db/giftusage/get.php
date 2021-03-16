<?php
namespace lib\db\giftusage;


class get
{


	public static function count_usage()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM giftusage ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function count_usage_id($_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM giftusage WHERE giftusage.gift_id = $_id";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function last_usage_id($_id)
	{
		$query  = "SELECT * FROM giftusage WHERE giftusage.gift_id = $_id ORDER BY giftusage.id DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function first_usage_id($_id)
	{
		$query  = "SELECT * FROM giftusage WHERE giftusage.gift_id = $_id ORDER BY giftusage.id ASC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function count_usage_user_id($_id)
	{
		$query  = "SELECT SUM(mycount.count) AS `mycountuser` FROM (SELECT 1 AS `count` FROM giftusage WHERE giftusage.gift_id = $_id GROUP BY giftusage.user_id) AS `mycount`";
		$result = \dash\db::get($query, 'mycountuser', true);
		return $result;
	}


	public static function chart_by_date_fa($_enddate, $_month_list)
	{
		$CASE = [];
		foreach ($_month_list as $month => $date)
		{
			$CASE[] = "WHEN giftusage.datecreated >= '$date[0] 00:00:00' AND giftusage.datecreated <= '$date[1] 23:59:59' THEN '$month'";
		}

		$CASE = " CASE ". implode(" ", $CASE). "  ELSE '0' END ";

		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				$CASE AS `month`
			FROM
				giftusage
			WHERE
				giftusage.datecreated >= '$_enddate'
			GROUP BY $CASE
		";
		$result = \dash\db::get($query, ['month', 'count']);
		return $result;
	}



	public static function chart_by_date_en($_enddate)
	{

		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				MONTH(giftusage.datecreated) AS `month`
			FROM
				giftusage
			WHERE
				giftusage.datecreated >= '$_enddate'
			GROUP BY MONTH(giftusage.datecreated)
		";

		$result = \dash\db::get($query, ['month', 'count']);

		return $result;
	}




}
?>