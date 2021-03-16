<?php
namespace lib\db\giftlookup;


class get
{


	public static function count_lookup()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM giftlookup ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function count_lookup_id($_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM giftlookup WHERE giftlookup.gift_id = $_id";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function count_lookup_id_valid($_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM giftlookup WHERE giftlookup.gift_id = $_id AND giftlookup.valid = 'yes' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function count_lookup_id_invalid($_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM giftlookup WHERE giftlookup.gift_id = $_id AND giftlookup.valid != 'yes' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}



	public static function count_lookupfaild()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM giftlookup WHERE giftlookup.valid != 'yes' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function chart_by_date_fa($_enddate, $_month_list)
	{
		$CASE = [];
		foreach ($_month_list as $month => $date)
		{
			$CASE[] = "WHEN giftlookup.datecreated >= '$date[0] 00:00:00' AND giftlookup.datecreated <= '$date[1] 23:59:59' THEN '$month'";
		}

		$CASE = " CASE ". implode(" ", $CASE). "  ELSE '0' END ";

		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				$CASE AS `month`
			FROM
				giftlookup
			WHERE
				giftlookup.datecreated >= '$_enddate'
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
				MONTH(giftlookup.datecreated) AS `month`
			FROM
				giftlookup
			WHERE
				giftlookup.datecreated >= '$_enddate'
			GROUP BY MONTH(giftlookup.datecreated)
		";

		$result = \dash\db::get($query, ['month', 'count']);

		return $result;
	}

}
?>