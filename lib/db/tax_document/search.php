<?php
namespace lib\db\tax_document;


class search
{
	public static function summary_detail($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				SUM(tax_document.total) AS `total`,
				SUM(tax_document.totaldiscount) AS `totaldiscount`,
				SUM(tax_document.totalvat) AS `totalvat`
			FROM tax_document
				$q[join]
				$q[where]
				$q[order]
		";

		$result = \dash\db::get($query, null, true);

		return $result;
	}


	public static function list($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =	"SELECT COUNT(*) AS `count`	FROM tax_document $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				tax_document.*,
				(SELECT SUM(tax_docdetail.debtor) FROM tax_docdetail WHERE tax_docdetail.tax_document_id = tax_document.id) AS `sum_debtor`,
				(SELECT SUM(tax_docdetail.creditor) FROM tax_docdetail WHERE tax_docdetail.tax_document_id = tax_document.id) AS `sum_creditor`,
				(SELECT COUNT(*) FROM tax_docdetail WHERE tax_docdetail.tax_document_id = tax_document.id) AS `item_count`
			FROM tax_document
			$q[join]
			$q[where]
			$q[order]
			$limit
		";

		$result = \dash\db::get($query);


		return $result;

	}
}
?>