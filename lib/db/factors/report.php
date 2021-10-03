<?php
namespace lib\db\factors;

class report
{
	public static function sale_report($_args)
	{

		switch ($_args['groupby'])
		{
		 	case 'date':
		 	default:
		 		$select_field = ", DATE(factors.date) AS `groupbykey` ";
		 		$group_by = "groupbykey";
		 		break;
		 }

		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				SUM(IFNULL(factors.qty, 0)) AS `qty`,
				SUM(IFNULL(factors.subprice, 0)) AS `subprice`,
				SUM(IFNULL(factors.subtotal, 0)) AS `subtotal`,
				SUM(IFNULL(factors.subvat, 0)) AS `subvat`,
				SUM(IFNULL(factors.subdiscount, 0)) AS `subdiscount`,
				SUM(IFNULL(factors.discount2, 0)) AS `discount2`,
				SUM(IFNULL(factors.shipping, 0)) AS `shipping`,
				SUM(IFNULL(factors.total, 0)) AS `total`,
				SUM(IFNULL(factors.item, 0)) AS `item`
				$select_field
			FROM
				factors
			WHERE
				factors.status != 'deleted'
			GROUP BY $group_by
		";

		$result = \dash\db::get($query);
		return $result;
	}
}
?>