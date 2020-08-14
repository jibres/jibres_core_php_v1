<?php
namespace lib\db\tax_document;


class get
{

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



	public static function detail_report()
	{

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
			GROUP BY tax_docdetail.details_id

		";
		$result = \dash\db::get($query);

		return $result;
	}



}
?>
