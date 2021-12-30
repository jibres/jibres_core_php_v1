<?php
namespace lib\db\irvat;


class search
{


	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM ir_vat $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, [], $q['limit']);
		}

		$query = "SELECT ir_vat.* FROM ir_vat $q[where] $q[order] $limit ";

		$result = \dash\pdo::get($query, [], null, false);

		return $result;
	}


	public static function summary($_and, $_or)
	{

		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, null, []);


		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				SUM(ir_vat.total) AS `total`,
				SUM(ir_vat.sumvat) AS `sumvat`,
				SUM(ir_vat.subtotalitembyvat) AS `subtotalitembyvat`,
				SUM(ir_vat.items) AS `items`,
				SUM(ir_vat.itemsvat) AS `itemsvat`
			FROM
				ir_vat
			$q[where]
		";

		$result = \dash\pdo::get($query, [], null, true);

		return $result;
	}



}
?>