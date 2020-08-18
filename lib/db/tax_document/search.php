<?php
namespace lib\db\tax_document;


class search
{

	private static function ready_to_sql($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$where = null;
		$q     = [];

		if($_and)
		{
			$_and = implode(' AND ', $_and);
			$q[] = "$_and";

		}

		if($_or)
		{
			$_or = implode(' OR ', $_or);
			$q[] = "($_or)";
		}

		if($q)
		{
			$where = 'WHERE '. implode(" AND ", $q);
		}

		$order = null;
		if($_order_sort && is_string($_order_sort))
		{
			$order = $_order_sort;
		}

		$pagination = null;
		if(array_key_exists('pagination', $_meta))
		{
			$pagination = $_meta['pagination'];
		}

		$limit = null;
		if(array_key_exists('limit', $_meta))
		{
			$limit = $_meta['limit'];
		}

		if(isset($_meta['join']) && is_array($_meta['join']) && $_meta['join'])
		{
			$join = implode(' ', $_meta['join']);
		}
		else
		{
			$join = null;
		}

		return
		[
			'where'      => $where,
			'order'      => $order,
			'pagination' => $pagination,
			'limit'      => $limit,
			'join'      => $join,
		];
	}



	public static function list($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

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