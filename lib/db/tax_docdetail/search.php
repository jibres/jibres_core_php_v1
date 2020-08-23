<?php
namespace lib\db\tax_docdetail;


class search
{
	public static function list($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =	"SELECT COUNT(*) AS `count`	FROM tax_docdetail INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}


		$query =
		"
			SELECT
				(
					SELECT SUM(IFNULL(myTaxDocDetail.debtor,0) - IFNULL(myTaxDocDetail.creditor,0))
					FROM tax_docdetail AS `myTaxDocDetail`
					INNER JOIN tax_document AS `myTaxDoc` ON myTaxDoc.id = myTaxDocDetail.tax_document_id
					WHERE
						myTaxDocDetail.year_id = tax_docdetail.year_id AND
						myTaxDocDetail.assistant_id = tax_docdetail.assistant_id AND
						myTaxDocDetail.details_id = tax_docdetail.details_id AND
						myTaxDoc.number <= tax_document.number
				)
				AS `balance_now`,
				tax_docdetail.*,
				tax_document.number,
				tax_document.desc AS `doc_desc`,
				tax_document.date,
				tax_document.status,
				assistant_detail.title AS `assistant_title`,
				details_detail.title AS `details_title`,
				(SELECT tax_coding.title FROM tax_coding WHERE tax_coding.id = details_detail.parent2) AS `total_title`,
				(SELECT tax_coding.id FROM tax_coding WHERE tax_coding.id = details_detail.parent2) AS `total_id`,
				(SELECT tax_coding.title FROM tax_coding WHERE tax_coding.id = details_detail.parent1) AS `group_title`,
				(SELECT tax_coding.id FROM tax_coding WHERE tax_coding.id = details_detail.parent1) AS `group_id`
			FROM tax_docdetail
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			LEFT JOIN tax_coding AS `assistant_detail` ON assistant_detail.id = tax_docdetail.assistant_id
			LEFT JOIN tax_coding AS `details_detail` ON details_detail.id = tax_docdetail.details_id
			$q[join]
			$q[where]
			$q[order]
			$limit
		";
		// $query =
		// "
		// 	SELECT
		// 		SUM(IFNULL(tax_docdetail.debtor,0) - IFNULL(tax_docdetail.creditor,0)) OVER(ORDER BY tax_document.number asc) as `balance_now`,
		// 		tax_docdetail.*,
		// 		tax_document.number,
		// 		tax_document.desc AS `doc_desc`,
		// 		tax_document.date,
		// 		tax_document.status,
		// 		assistant_detail.title AS `assistant_title`,
		// 		details_detail.title AS `details_title`,
		// 		(SELECT tax_coding.title FROM tax_coding WHERE tax_coding.id = details_detail.parent2) AS `total_title`,
		// 		(SELECT tax_coding.id FROM tax_coding WHERE tax_coding.id = details_detail.parent2) AS `total_id`,
		// 		(SELECT tax_coding.title FROM tax_coding WHERE tax_coding.id = details_detail.parent1) AS `group_title`,
		// 		(SELECT tax_coding.id FROM tax_coding WHERE tax_coding.id = details_detail.parent1) AS `group_id`
		// 	FROM tax_docdetail
		// 	INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
		// 	LEFT JOIN tax_coding AS `assistant_detail` ON assistant_detail.id = tax_docdetail.assistant_id
		// 	LEFT JOIN tax_coding AS `details_detail` ON details_detail.id = tax_docdetail.details_id
		// 	$q[join]
		// 	$q[where]
		// 	$q[order]
		// 	$limit
		// ";
		$result = \dash\db::get($query);
		return $result;

	}


	public static function summary_list($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$query =
		"
			SELECT
				SUM(tax_docdetail.debtor)  AS `debtor`,
				SUM(tax_docdetail.creditor)  AS `creditor`,
				(SUM(tax_docdetail.debtor) - SUM(tax_docdetail.creditor)) AS `balance`
			FROM tax_docdetail
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			$q[join]
			$q[where]
			$q[order]
		";
		$result = \dash\db::get($query, null, true);

		return $result;

	}
}
?>