<?php
namespace lib\db\tax_document;


class get
{

	public static function check_duplicate_type($_year_id, $_type)
	{
		$query = "SELECT * FROM tax_document WHERE tax_document.year_id = $_year_id AND tax_document.type = '$_type' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function opening_doc($_year_id)
	{
		$query = "SELECT * FROM tax_document WHERE tax_document.year_id = $_year_id AND tax_document.type = 'opening' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function list_reset_number($_year_id)
	{
		$query = "SELECT tax_document.id, tax_document.number FROM tax_document WHERE tax_document.year_id = $_year_id ORDER BY tax_document.date ASC, tax_document.number ASC, tax_document.subnumber ASC, tax_document.id ASC ";
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



	public static function detail_report($_args)
	{
		$year = null;
		if(isset($_args['year_id']) && $_args['year_id'])
		{
			$year = " AND tax_docdetail.year_id = $_args[year_id] ";
		}

		$startdate = null;
		if(isset($_args['startdate']) && $_args['startdate'])
		{
			$startdate = " AND tax_document.date >= '$_args[startdate]' ";
		}

		$enddate = null;
		if(isset($_args['enddate']) && $_args['enddate'])
		{
			$enddate = " AND tax_document.date <= '$_args[enddate]' ";
		}

		$result = [];

		$query =
		"
			SELECT
				tax_docdetail.details_id,
				CONCAT(1, LPAD(IFNULL(tax_coding.parent1, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent3, 0), 6, '0'), LPAD(tax_coding.id, 6, '0')) AS `string_id`,
				tax_coding.title AS `details_title`,
				tax_coding.parent1 AS `group_id`,
				tax_coding.parent2 AS `total_id`,
				tax_coding.parent3 AS `assistant_id`,
				SUM(IFNULL(tax_docdetail.debtor, 0)) AS `debtor`,
				SUM(IFNULL(tax_docdetail.creditor, 0)) AS `creditor`
			FROM
				tax_docdetail
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			LEFT JOIN tax_coding ON tax_coding.id = tax_docdetail.details_id
			WHERE
				tax_document.status != 'draft' AND
				tax_document.type = 'normal'
				$year
				$startdate
				$enddate
			GROUP BY tax_docdetail.details_id
		";

		$result['normal'] = \dash\db::get($query);

		$query =
		"
			SELECT
				tax_docdetail.details_id,
				CONCAT(1, LPAD(IFNULL(tax_coding.parent1, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent3, 0), 6, '0'), LPAD(tax_coding.id, 6, '0')) AS `string_id`,
				tax_coding.title AS `details_title`,
				tax_coding.parent1 AS `group_id`,
				tax_coding.parent2 AS `total_id`,
				tax_coding.parent3 AS `assistant_id`,
				SUM(IFNULL(tax_docdetail.debtor, 0)) AS `debtor`,
				SUM(IFNULL(tax_docdetail.creditor, 0)) AS `creditor`
			FROM
				tax_docdetail
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			LEFT JOIN tax_coding ON tax_coding.id = tax_docdetail.details_id
			WHERE
				tax_document.status != 'draft' AND
				tax_document.type = 'opening'
				$year
				$startdate
				$enddate
			GROUP BY tax_docdetail.details_id
		";

		$result['opening'] = \dash\db::get($query);


		$query =
		"
			SELECT
				tax_coding.*,
				CONCAT(1, LPAD(IFNULL(tax_coding.parent1, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent3, 0), 6, '0'), LPAD(tax_coding.id, 6, '0')) AS `string_id`
			FROM tax_coding
			WHERE tax_coding.type IN ('group', 'total', 'assistant')
			ORDER BY tax_coding.parent1 ASC, tax_coding.parent2 ASC, tax_coding.parent3 ASC
		";

		$result['coding'] = \dash\db::get($query);

		return $result;
	}



	public static function assistant_report($_args)
	{
		$year = null;
		if(isset($_args['year_id']) && $_args['year_id'])
		{
			$year = " AND tax_docdetail.year_id = $_args[year_id] ";
		}

		$startdate = null;
		if(isset($_args['startdate']) && $_args['startdate'])
		{
			$startdate = " AND tax_document.date >= '$_args[startdate]' ";
		}

		$enddate = null;
		if(isset($_args['enddate']) && $_args['enddate'])
		{
			$enddate = " AND tax_document.date <= '$_args[enddate]' ";
		}

		$query =
		"
			SELECT
				MAX(assistant.parent1) AS `group_id`,
				MAX(assistant.parent2) AS `total_id`,
				tax_docdetail.assistant_id AS `assistant_id`,
				SUM(tax_docdetail.debtor) AS `debtor`,
				SUM(tax_docdetail.creditor) AS `creditor`,
				MAX(group.title) AS `group_title`,
				MAX(group.code) AS `group_code`,
				MAX(total.title) AS `total_title`,
				MAX(total.code) AS `total_code`,
				MAX(assistant.title) AS `assistant_title`,
				MAX(assistant.code) AS `assistant_code`
			FROM
				tax_docdetail
			LEFT JOIN tax_coding AS `assistant` ON assistant.id = tax_docdetail.assistant_id
			LEFT JOIN tax_coding AS `total` ON total.id = assistant.parent2
			LEFT JOIN tax_coding AS `group` ON group.id = assistant.parent1
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			WHERE tax_document.status != 'draft' $year $startdate $enddate
			GROUP BY tax_docdetail.assistant_id
			ORDER BY assistant.parent1 ASC, assistant.parent2 ASC, assistant.parent3 ASC, assistant.id ASC

		";
		$result = \dash\db::get($query);
		return $result;
	}



	public static function total_report($_args)
	{
		$year = null;
		if(isset($_args['year_id']) && $_args['year_id'])
		{
			$year = " AND tax_docdetail.year_id = $_args[year_id] ";
		}

		$startdate = null;
		if(isset($_args['startdate']) && $_args['startdate'])
		{
			$startdate = " AND tax_document.date >= '$_args[startdate]' ";
		}

		$enddate = null;
		if(isset($_args['enddate']) && $_args['enddate'])
		{
			$enddate = " AND tax_document.date <= '$_args[enddate]' ";
		}


		$query =
		"
			SELECT
				SUM(tax_docdetail.debtor) AS `debtor`,
				SUM(tax_docdetail.creditor) AS `creditor`,
				MAX(group.title) AS `group_title`,
				MAX(group.code) AS `group_code`,
				MAX(group.parent1) AS `group_id`,
				MAX(total.parent2) AS `total_id`,
				(SELECT MAX(tax_coding.title) from tax_coding WHERE tax_coding.id = total.parent2) as `total_title`
			FROM
				tax_docdetail

			LEFT JOIN tax_coding AS `total` ON total.id = tax_docdetail.assistant_id
			LEFT JOIN tax_coding AS `group` ON group.id = total.parent1
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			WHERE tax_document.status != 'draft' $year $startdate $enddate
			GROUP BY total.parent2
			ORDER BY total.parent2 ASC

		";
		$result = \dash\db::get($query);


		return $result;
	}


	public static function group_report($_args)
	{
		$year = null;
		if(isset($_args['year_id']) && $_args['year_id'])
		{
			$year = " AND tax_docdetail.year_id = $_args[year_id] ";
		}

		$startdate = null;
		if(isset($_args['startdate']) && $_args['startdate'])
		{
			$startdate = " AND tax_document.date >= '$_args[startdate]' ";
		}

		$enddate = null;
		if(isset($_args['enddate']) && $_args['enddate'])
		{
			$enddate = " AND tax_document.date <= '$_args[enddate]' ";
		}


		$query =
		"
			SELECT
				group.parent1 AS `group_id`,
				SUM(tax_docdetail.debtor) AS `debtor`,
				SUM(tax_docdetail.creditor) AS `creditor`,
				(SELECT tax_coding.title from tax_coding WHERE tax_coding.id = group.parent1) as `group_title`
			FROM
				tax_docdetail

			LEFT JOIN tax_coding AS `group` ON group.id = tax_docdetail.assistant_id
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			WHERE tax_document.status != 'draft' $year $startdate $enddate
			GROUP BY group.parent1
			ORDER BY group.parent1 ASC

		";
		$result = \dash\db::get($query);

		return $result;
	}



}
?>
