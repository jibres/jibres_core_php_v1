<?php
namespace lib\db\tax_document;


class get
{

	public static function list_reset_number($_year_id)
	{
		$query = "SELECT tax_document.id, tax_document.number FROM tax_document WHERE tax_document.year_id = $_year_id ORDER BY tax_document.date ASC, tax_document.number ASC, tax_document.id ASC ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function last_number()
	{
		$query = "SELECT MAX(tax_document.number) as `number` FROM tax_document ";
		$result = \dash\db::get($query, 'number', true);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT * FROM tax_document WHERE tax_document.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function check_duplicate_number($_number)
	{
		$query = "SELECT * FROM tax_document WHERE tax_document.number = $_number LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function detail_report($_year_id)
	{
		$year = null;
		if($_year_id)
		{
			$year = " AND tax_docdetail.year_id = $_year_id ";
		}

		$query =
		"
			SELECT
				SUM(tax_docdetail.debtor) AS `debtor`,
				SUM(tax_docdetail.creditor) AS `creditor`,
				MAX(group.title) AS `group_title`,
				MAX(group.code) AS `group_code`,
				MAX(total.title) AS `total_title`,
				MAX(total.code) AS `total_code`,
				MAX(assistant.title) AS `assistant_title`,
				MAX(assistant.code) AS `assistant_code`,
				MAX(details.title) AS `details_title`,
				MAX(details.code) AS `details_code`
			FROM
				tax_docdetail
			LEFT JOIN tax_coding AS `details` ON details.id = tax_docdetail.details_id
			LEFT JOIN tax_coding AS `assistant` ON assistant.id = tax_docdetail.assistant_id
			LEFT JOIN tax_coding AS `total` ON total.id = details.parent2
			LEFT JOIN tax_coding AS `group` ON group.id = details.parent1
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			WHERE tax_document.status != 'draft' $year
			GROUP BY tax_docdetail.details_id

		";
		$result = \dash\db::get($query);
		return $result;
	}



	public static function total_report($_year_id)
	{
		$year = null;
		if($_year_id)
		{
			$year = " AND tax_docdetail.year_id = $_year_id ";
		}

		$query =
		"
			SELECT
				SUM(tax_docdetail.debtor) AS `debtor`,
				SUM(tax_docdetail.creditor) AS `creditor`,
				MAX(group.title) AS `group_title`,
				MAX(group.code) AS `group_code`,
				MAX(total.title) AS `total_title`,
				MAX(total.code) AS `total_code`
			FROM
				tax_docdetail

			LEFT JOIN tax_coding AS `total` ON total.id = tax_docdetail.assistant_id
			LEFT JOIN tax_coding AS `group` ON group.id = total.parent1
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			WHERE tax_document.status != 'draft' $year
			GROUP BY total.parent2

		";
		$result = \dash\db::get($query);

		return $result;
	}


	public static function group_report($_year_id)
	{
		$year = null;
		if($_year_id)
		{
			$year = " AND tax_docdetail.year_id = $_year_id ";
		}

		$query =
		"
			SELECT
				SUM(tax_docdetail.debtor) AS `debtor`,
				SUM(tax_docdetail.creditor) AS `creditor`,
				MAX(group.title) AS `group_title`,
				MAX(group.code) AS `group_code`
			FROM
				tax_docdetail

			LEFT JOIN tax_coding AS `group` ON group.id = tax_docdetail.assistant_id
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			WHERE tax_document.status != 'draft' $year
			GROUP BY group.parent1

		";
		$result = \dash\db::get($query);

		return $result;
	}



}
?>
