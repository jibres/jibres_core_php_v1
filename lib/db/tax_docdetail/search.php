<?php
namespace lib\db\tax_docdetail;


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

		$pagination_query =	"SELECT COUNT(*) AS `count`	FROM tax_docdetail $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				tax_docdetail.*,
				tax_document.number,
				tax_document.date,
				tax_document.status,
				(SELECT tax_coding.title FROM tax_coding WHERE tax_coding.id = tax_docdetail.details_id LIMIT 1) AS `details_title`,
				(SELECT tax_coding.title FROM tax_coding WHERE tax_coding.id = tax_docdetail.assistant_id LIMIT 1) AS `assistant_title`,
				(SELECT tax_coding.title FROM tax_coding WHERE tax_coding.id = (SELECT tax_coding.parent2 FROM tax_coding WHERE tax_coding.id = tax_docdetail.assistant_id LIMIT 1) LIMIT 1) AS `total_title`,
				(SELECT tax_coding.id FROM tax_coding WHERE tax_coding.id = (SELECT tax_coding.parent2 FROM tax_coding WHERE tax_coding.id = tax_docdetail.assistant_id LIMIT 1) LIMIT 1) AS `total_id`,
				(SELECT tax_coding.title FROM tax_coding WHERE tax_coding.id = (SELECT tax_coding.parent1 FROM tax_coding WHERE tax_coding.id = tax_docdetail.assistant_id LIMIT 1) LIMIT 1) AS `group_title`,
				(SELECT tax_coding.id FROM tax_coding WHERE tax_coding.id = (SELECT tax_coding.parent1 FROM tax_coding WHERE tax_coding.id = tax_docdetail.assistant_id LIMIT 1) LIMIT 1) AS `group_id`
			FROM tax_docdetail
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
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