<?php
namespace lib\db\tax_document;


class get
{

	public static function summary_costs($_year_id)
	{
		return self::summary_special_dashboard_number('costs', $_year_id);
	}

	public static function summary_salary($_year_id)
	{
		return self::summary_special_dashboard_number('salary', $_year_id);
	}

	public static function summary_costandbenefit($_year_id)
	{
		return self::summary_special_dashboard_number('costandbenefit', $_year_id);
	}

	public static function summary_income($_year_id)
	{
		return self::summary_special_dashboard_number('income', $_year_id);
	}

	public static function summary_asset($_year_id)
	{
		return self::summary_special_dashboard_number('asset', $_year_id);
	}




	private static function summary_special_dashboard_number($_type, $_year_id)
	{
		$year_id = null;
		if($_year_id)
		{
			$year_id = " AND tax_document.year_id = $_year_id ";
		}

		$type = null;
		switch ($_type)
		{
			case 'costs':
				$type = " AND tax_coding.code LIKE '7%' AND tax_coding.code NOT LIKE '77%' AND tax_coding.code NOT LIKE '71%' ";
				break;

			case 'salary':
				$type = " AND tax_coding.code LIKE '71%'  ";
				break;

			case 'costandbenefit':
				$type = " AND tax_coding.code LIKE '37%'  ";
				break;

			case 'income':
				$type = " AND (tax_coding.code LIKE '6%' OR tax_coding.code LIKE '77%' ) ";
				break;


			case 'asset':
				$type = " AND (tax_coding.code LIKE '1%' OR tax_coding.code LIKE '2%' ) ";
				break;

			default:
				break;
		}

		$query  =
		"
			SELECT
				SUM(IFNULL(tax_docdetail.debtor, 0) - IFNULL(tax_docdetail.creditor, 0)) AS `balance`
			FROM
				tax_docdetail
			JOIN tax_coding ON tax_coding.id = tax_docdetail.assistant_id
			JOIN tax_document ON tax_docdetail.tax_document_id = tax_document.id
			WHERE
				tax_document.status = 'lock'
			$year_id
			$type
		";

		$result = \dash\pdo::get($query, [], 'balance', true);

		return $result;

	}

	public static function count_group_by_template($_year_id)
	{
		$year_id = null;
		if($_year_id)
		{
			$year_id = " AND tax_document.year_id = $_year_id ";
		}

		$query  =
		"
			SELECT
				count(*) AS `count`,
				tax_document.template AS `template`
			FROM
				tax_document
			WHERE tax_document.status NOT IN ('deleted')
			$year_id

			GROUP BY tax_document.template
		";

		$result = \dash\pdo::get($query, [], ['template', 'count']);
		return $result;
	}



	public static function count_all_doc_with_attachment($_year_id)
	{
		$year_id = null;
		if($_year_id)
		{
			$year_id = "AND tax_document.year_id = $_year_id ";
		}

		$query  = " SELECT count(*) AS `count` FROM tax_document WHERE tax_document.status IN ('draft', 'lock') AND tax_document.gallery IS NULL $year_id ";

		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}


	public static function count_all_doc_lock($_year_id)
	{
		$year_id = null;
		if($_year_id)
		{
			$year_id = "AND tax_document.year_id = $_year_id ";
		}

		$query  = " SELECT count(*) AS `count` FROM tax_document WHERE tax_document.status = 'lock' $year_id ";

		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}


	public static function count_all_doc($_year_id)
	{
		$year_id = null;
		if($_year_id)
		{
			$year_id = "AND tax_document.year_id = $_year_id ";
		}

		$query  = " SELECT count(*) AS `count` FROM tax_document WHERE tax_document.status NOT IN ('deleted') $year_id ";

		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}


	public static function chart_by_date_fa($_enddate, $_end_year, $_month_list)
	{
		$CASE = [];
		foreach ($_month_list as $month => $date)
		{
			$CASE[] = "WHEN tax_document.date >= '$date[0]' AND tax_document.date <= '$date[1]' THEN '$month'";
		}

		$CASE = " CASE ". implode(" ", $CASE). "  ELSE '0' END ";


		$query  =
		"
			SELECT
				count(*) AS `count`,
				$CASE AS `month`
			FROM
				tax_document
			WHERE
				tax_document.status IN ('draft', 'lock') AND
				tax_document.date >= '$_enddate' AND tax_document.date <= '$_end_year'
			GROUP BY `month`
		";

		$result = \dash\pdo::get($query);

		return $result;
	}



	public static function chart_by_date_en($_enddate, $_end_year)
	{
		$query  =
		"
			SELECT
				count(*) AS `count`,
				CONCAT(YEAR(tax_document.date), '-', LPAD(MONTH(tax_document.date), 2, '0')) AS `month`
			FROM
				tax_document
			WHERE
				tax_document.status IN ('draft', 'lock') AND
				tax_document.date >= '$_enddate' AND tax_document.date <= '$_end_year'
			GROUP BY `month`
		";

		$result = \dash\pdo::get($query);

		return $result;
	}

	public static function check_duplicate_type($_year_id, $_type)
	{
		$query = "SELECT * FROM tax_document WHERE tax_document.year_id = $_year_id AND tax_document.type = '$_type' LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function opening_doc($_year_id)
	{
		$query = "SELECT * FROM tax_document WHERE tax_document.year_id = $_year_id AND tax_document.type = 'opening' LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

	public static function list_reset_number($_year_id)
	{
		$query = "SELECT tax_document.id, tax_document.number FROM tax_document WHERE tax_document.year_id = $_year_id ORDER BY tax_document.date ASC, tax_document.subnumber ASC, tax_document.id ASC ";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function last_number($_year_id = null)
	{
		$year_id = null;
		if($_year_id)
		{
			$year_id = "WHERE tax_document.year_id = '$_year_id' ";
		}
		$query = "SELECT MAX(tax_document.number) as `number` FROM tax_document $year_id";

		$result = \dash\pdo::get($query, [], 'number', true);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT * FROM tax_document WHERE tax_document.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function check_duplicate_number($_number, $_year_id)
	{
		$query = "SELECT * FROM tax_document WHERE tax_document.number = $_number AND tax_document.year_id = $_year_id AND tax_document.status = 'lock' LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
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
				CONCAT(1, LPAD(IFNULL(tax_coding.parent1, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent3, 0), 6, '0'), LPAD(tax_coding.id, 6, '0')) AS `string_id`,
				tax_coding.parent1 AS `group_id`,
				NULL AS `group_title`,
				tax_coding.parent2 AS `total_id`,
				NULL AS `total_title`,
				tax_coding.parent3 AS `assistant_id`,
				NULL AS `assistant_title`,
				tax_docdetail.details_id,
				tax_coding.title AS `details_title`,
				NULL AS `total_code`,
				NULL AS `assistant_code`,
				NULL AS `remain_debtor`,
				NULL AS `remain_creditor`,
				NULL AS `sum_debtor`,
				NULL AS `sum_creditor`,
				NULL AS `opening_debtor`,
				NULL AS `opening_creditor`,
				NULL AS `opening`,
				NULL AS `current`,
				SUM(IFNULL(tax_docdetail.debtor, 0)) AS `debtor`,
				SUM(IFNULL(tax_docdetail.creditor, 0)) AS `creditor`
			FROM
				tax_docdetail
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			LEFT JOIN tax_coding ON tax_coding.id = tax_docdetail.details_id
			WHERE
				tax_document.status = 'lock' AND
				tax_document.type IN ('normal', 'closing')
				$year
				$startdate
				$enddate
			GROUP BY tax_docdetail.details_id
		";

		$result['normal'] = \dash\pdo::get($query);

		$query =
		"
			SELECT
				CONCAT(1, LPAD(IFNULL(tax_coding.parent1, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent3, 0), 6, '0'), LPAD(tax_coding.id, 6, '0')) AS `string_id`,
				tax_coding.parent1 AS `group_id`,
				NULL AS `group_title`,
				tax_coding.parent2 AS `total_id`,
				NULL AS `total_title`,
				tax_coding.parent3 AS `assistant_id`,
				NULL AS `assistant_title`,
				tax_docdetail.details_id,
				tax_coding.title AS `details_title`,
				NULL AS `total_code`,
				NULL AS `assistant_code`,
				NULL AS `remain_debtor`,
				NULL AS `remain_creditor`,
				NULL AS `sum_debtor`,
				NULL AS `sum_creditor`,
				NULL AS `opening_debtor`,
				NULL AS `opening_creditor`,
				NULL AS `opening`,
				NULL AS `current`,
				SUM(IFNULL(tax_docdetail.debtor, 0)) AS `debtor`,
				SUM(IFNULL(tax_docdetail.creditor, 0)) AS `creditor`
			FROM
				tax_docdetail
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			LEFT JOIN tax_coding ON tax_coding.id = tax_docdetail.details_id
			WHERE
				tax_document.status = 'lock' AND
				tax_document.type = 'opening'
				$year
				$startdate
				$enddate
			GROUP BY tax_docdetail.details_id
		";

		$result['opening'] = \dash\pdo::get($query);


		$query =
		"
			SELECT
				tax_coding.*,
				CONCAT(1, LPAD(IFNULL(tax_coding.parent1, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent3, 0), 6, '0'), LPAD(tax_coding.id, 6, '0')) AS `string_id`
			FROM tax_coding
			WHERE tax_coding.type IN ('group', 'total', 'assistant')
			ORDER BY tax_coding.parent1 ASC, tax_coding.parent2 ASC, tax_coding.parent3 ASC
		";

		$result['coding'] = \dash\pdo::get($query);

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


		$result = [];

		$query =
		"
			SELECT
				CONCAT(1, LPAD(IFNULL(tax_coding.parent1, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent3, 0), 6, '0'), LPAD(tax_coding.id, 6, '0')) AS `string_id`,
				tax_coding.parent1 AS `group_id`,
				NULL AS `group_title`,
				tax_coding.parent2 AS `total_id`,
				NULL AS `total_title`,
				tax_docdetail.assistant_id,
				tax_coding.title AS `assistant_title`,
				NULL AS `total_code`,
				NULL AS `assistant_code`,
				NULL AS `remain_debtor`,
				NULL AS `remain_creditor`,
				NULL AS `sum_debtor`,
				NULL AS `sum_creditor`,
				NULL AS `opening_debtor`,
				NULL AS `opening_creditor`,
				NULL AS `opening`,
				NULL AS `current`,
				SUM(IFNULL(tax_docdetail.debtor, 0)) AS `debtor`,
				SUM(IFNULL(tax_docdetail.creditor, 0)) AS `creditor`
			FROM
				tax_docdetail
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			LEFT JOIN tax_coding ON tax_coding.id = tax_docdetail.assistant_id
			WHERE
				tax_document.status = 'lock' AND
				tax_document.type IN ('normal', 'closing')
				$year
				$startdate
				$enddate
			GROUP BY tax_docdetail.assistant_id
		";

		$result['normal'] = \dash\pdo::get($query);

		$query =
		"
			SELECT
				CONCAT(1, LPAD(IFNULL(tax_coding.parent1, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent3, 0), 6, '0'), LPAD(tax_coding.id, 6, '0')) AS `string_id`,
				tax_coding.parent1 AS `group_id`,
				NULL AS `group_title`,
				tax_coding.parent2 AS `total_id`,
				NULL AS `total_title`,
				tax_docdetail.assistant_id,
				tax_coding.title AS `assistant_title`,
				NULL AS `total_code`,
				NULL AS `assistant_code`,
				NULL AS `remain_debtor`,
				NULL AS `remain_creditor`,
				NULL AS `sum_debtor`,
				NULL AS `sum_creditor`,
				NULL AS `opening_debtor`,
				NULL AS `opening_creditor`,
				NULL AS `opening`,
				NULL AS `current`,
				SUM(IFNULL(tax_docdetail.debtor, 0)) AS `debtor`,
				SUM(IFNULL(tax_docdetail.creditor, 0)) AS `creditor`
			FROM
				tax_docdetail
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			LEFT JOIN tax_coding ON tax_coding.id = tax_docdetail.assistant_id
			WHERE
				tax_document.status = 'lock' AND
				tax_document.type = 'opening'
				$year
				$startdate
				$enddate
			GROUP BY tax_docdetail.assistant_id
		";
		$result['opening'] = \dash\pdo::get($query);


		$query =
		"
			SELECT
				tax_coding.*,
				CONCAT(1, LPAD(IFNULL(tax_coding.parent1, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent3, 0), 6, '0'), LPAD(tax_coding.id, 6, '0')) AS `string_id`
			FROM tax_coding
			WHERE tax_coding.type IN ('group', 'total', 'assistant')
			ORDER BY tax_coding.parent1 ASC, tax_coding.parent2 ASC, tax_coding.parent3 ASC
		";

		$result['coding'] = \dash\pdo::get($query);

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


		$result = [];

		$query =
		"
			SELECT
				CONCAT(1, LPAD(IFNULL(MAX(tax_coding.parent1), 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0')) AS `string_id`,
				MAX(tax_coding.parent1) AS `group_id`,
				NULL AS `group_title`,
				tax_coding.parent2 AS `total_id`,
				MAX(tax_coding.title) AS `total_title`,
				NULL AS `total_code`,
				NULL AS `remain_debtor`,
				NULL AS `remain_creditor`,
				NULL AS `sum_debtor`,
				NULL AS `sum_creditor`,
				NULL AS `opening_debtor`,
				NULL AS `opening_creditor`,
				NULL AS `opening`,
				NULL AS `current`,
				SUM(IFNULL(tax_docdetail.debtor, 0)) AS `debtor`,
				SUM(IFNULL(tax_docdetail.creditor, 0)) AS `creditor`
			FROM
				tax_docdetail
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			LEFT JOIN tax_coding ON tax_coding.id = tax_docdetail.assistant_id
			WHERE
				tax_document.status = 'lock' AND
				tax_document.type IN ('normal', 'closing')
				$year
				$startdate
				$enddate
			GROUP BY tax_coding.parent2
		";

		$result['normal'] = \dash\pdo::get($query);


		$query =
		"
			SELECT
				CONCAT(1, LPAD(IFNULL(MAX(tax_coding.parent1), 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0')) AS `string_id`,
				MAX(tax_coding.parent1) AS `group_id`,
				NULL AS `group_title`,
				tax_coding.parent2 AS `total_id`,
				MAX(tax_coding.title) AS `total_title`,
				NULL AS `total_code`,
				NULL AS `remain_debtor`,
				NULL AS `remain_creditor`,
				NULL AS `sum_debtor`,
				NULL AS `sum_creditor`,
				NULL AS `opening_debtor`,
				NULL AS `opening_creditor`,
				NULL AS `opening`,
				NULL AS `current`,
				SUM(IFNULL(tax_docdetail.debtor, 0)) AS `debtor`,
				SUM(IFNULL(tax_docdetail.creditor, 0)) AS `creditor`
			FROM
				tax_docdetail
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			LEFT JOIN tax_coding ON tax_coding.id = tax_docdetail.assistant_id
			WHERE
				tax_document.status = 'lock' AND
				tax_document.type = 'opening'
				$year
				$startdate
				$enddate
			GROUP BY tax_coding.parent2
		";
		$result['opening'] = \dash\pdo::get($query);


		$query =
		"
			SELECT
				tax_coding.*,
				CONCAT(1, LPAD(IFNULL(tax_coding.parent1, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0')) AS `string_id`
			FROM tax_coding
			WHERE tax_coding.type IN ('group', 'total')
			ORDER BY tax_coding.parent1 ASC, tax_coding.parent2 ASC, tax_coding.parent3 ASC
		";

		$result['coding'] = \dash\pdo::get($query);

		return $result;
	}


	public static function report_journal($_args)
	{
		$select_startdate = null;
		$select_enddate = null;

		$year = null;
		if(isset($_args['year_id']) && $_args['year_id'])
		{
			$year = " AND tax_docdetail.year_id = $_args[year_id] ";
		}

		$startdate = null;
		if(isset($_args['startdate']) && $_args['startdate'])
		{
			$startdate = " AND tax_document.date >= '$_args[startdate]' ";
			$select_startdate = " '$_args[startdate]' AS `startdate`, ";
		}

		$enddate = null;
		if(isset($_args['enddate']) && $_args['enddate'])
		{
			$enddate = " AND tax_document.date <= '$_args[enddate]' ";
			$select_enddate = " '$_args[enddate]' AS `enddate`, ";
		}


		$query =
		"
			SELECT
				CONCAT(1, LPAD(IFNULL(MAX(tax_coding.parent1), 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0')) AS `string_id`,
				MAX(tax_coding.parent1) AS `group_id`,
				NULL AS `group_title`,
				tax_coding.parent2 AS `total_id`,
				MAX(tax_coding.title) AS `total_title`,
				NULL AS `remain_debtor`,
				NULL AS `remain_creditor`,
				NULL AS `sum_debtor`,
				NULL AS `sum_creditor`,
				NULL AS `current`,
				'$_args[type]' AS `type`,
				$select_startdate $select_enddate
				SUM(IFNULL(tax_docdetail.debtor, 0)) AS `debtor`,
				SUM(IFNULL(tax_docdetail.creditor, 0)) AS `creditor`
			FROM
				tax_docdetail
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			LEFT JOIN tax_coding ON tax_coding.id = tax_docdetail.assistant_id
			WHERE
				tax_document.status = 'lock' AND
				tax_document.type = '$_args[type]'
				$year
				$startdate
				$enddate
			GROUP BY tax_coding.parent2
		";

		$result = \dash\pdo::get($query);

		return $result;

	}


	public static function report_journal_coding()
	{
		$query =
		"
			SELECT
				tax_coding.*,
				CONCAT(1, LPAD(IFNULL(tax_coding.parent1, 0), 6, '0'), LPAD(IFNULL(tax_coding.parent2, 0), 6, '0')) AS `string_id`
			FROM tax_coding
			WHERE tax_coding.type IN ('group', 'total')
			ORDER BY tax_coding.parent1 ASC, tax_coding.parent2 ASC, tax_coding.parent3 ASC
		";

		$result = \dash\pdo::get($query);
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


		$result = [];

		$query =
		"
			SELECT
				group.parent1 AS `group_id`,
				NULL AS `group_title`,
				NULL AS `group_code`,
				NULL AS `remain_debtor`,
				NULL AS `remain_creditor`,
				NULL AS `sum_debtor`,
				NULL AS `sum_creditor`,
				NULL AS `opening_debtor`,
				NULL AS `opening_creditor`,
				NULL AS `opening`,
				NULL AS `current`,
				SUM(IFNULL(tax_docdetail.debtor, 0)) AS `debtor`,
				SUM(IFNULL(tax_docdetail.creditor, 0)) AS `creditor`
			FROM
				tax_docdetail
			LEFT JOIN tax_coding AS `group` ON group.id = tax_docdetail.assistant_id
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			WHERE tax_document.status = 'lock' AND tax_document.type IN ('normal', 'closing') $year $startdate $enddate
			GROUP BY group.parent1
			ORDER BY group.parent1 ASC
		";

		$result['normal'] = \dash\pdo::get($query);

		$query =
		"
			SELECT
				group.parent1 AS `group_id`,
				NULL AS `group_title`,
				NULL AS `group_code`,
				NULL AS `remain_debtor`,
				NULL AS `remain_creditor`,
				NULL AS `sum_debtor`,
				NULL AS `sum_creditor`,
				NULL AS `opening_debtor`,
				NULL AS `opening_creditor`,
				NULL AS `opening`,
				NULL AS `current`,
				SUM(IFNULL(tax_docdetail.debtor, 0)) AS `debtor`,
				SUM(IFNULL(tax_docdetail.creditor, 0)) AS `creditor`
			FROM
				tax_docdetail
			LEFT JOIN tax_coding AS `group` ON group.id = tax_docdetail.assistant_id
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			WHERE tax_document.status = 'lock' AND tax_document.type = 'opening' $year $startdate $enddate
			GROUP BY group.parent1
			ORDER BY group.parent1 ASC
		";

		$result['opening'] = \dash\pdo::get($query);


		$query = " SELECT tax_coding.* FROM tax_coding WHERE tax_coding.type = 'group' ";

		$result['coding'] = \dash\pdo::get($query);


		return $result;

	}


	public static function group_report_balancesheet($_args)
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
				balancesheet.naturegroup,
				group.parent1 AS `group_id`,
				NULL AS `group_title`,
				NULL AS `group_code`,
				NULL AS `remain_debtor`,
				NULL AS `remain_creditor`,
				NULL AS `sum_debtor`,
				NULL AS `sum_creditor`,
				NULL AS `opening_debtor`,
				NULL AS `opening_creditor`,
				NULL AS `opening`,
				NULL AS `current`,
				SUM(IFNULL(tax_docdetail.debtor, 0)) AS `debtor`,
				SUM(IFNULL(tax_docdetail.creditor, 0)) AS `creditor`
			FROM
				tax_docdetail
			LEFT JOIN tax_coding AS `group` ON group.id = tax_docdetail.assistant_id
			LEFT JOIN tax_coding AS `balancesheet` ON balancesheet.id = group.parent1
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			WHERE tax_document.status = 'lock' AND tax_document.type IN ('normal', 'closing') $year $startdate $enddate
			GROUP BY group.parent1
			ORDER BY group.parent1 ASC
		";

		$result['normal'] = \dash\pdo::get($query);

		$query =
		"
			SELECT
				balancesheet.naturegroup,
				group.parent1 AS `group_id`,
				NULL AS `group_title`,
				NULL AS `group_code`,
				NULL AS `remain_debtor`,
				NULL AS `remain_creditor`,
				NULL AS `sum_debtor`,
				NULL AS `sum_creditor`,
				NULL AS `opening_debtor`,
				NULL AS `opening_creditor`,
				NULL AS `opening`,
				NULL AS `current`,
				SUM(IFNULL(tax_docdetail.debtor, 0)) AS `debtor`,
				SUM(IFNULL(tax_docdetail.creditor, 0)) AS `creditor`
			FROM
				tax_docdetail
			LEFT JOIN tax_coding AS `group` ON group.id = tax_docdetail.assistant_id
			LEFT JOIN tax_coding AS `balancesheet` ON balancesheet.id = group.parent1
			INNER JOIN tax_document ON tax_document.id = tax_docdetail.tax_document_id
			WHERE tax_document.status = 'lock' AND tax_document.type = 'opening' $year $startdate $enddate
			GROUP BY group.parent1
			ORDER BY group.parent1 ASC
		";

		$result['opening'] = \dash\pdo::get($query);

		$query = " SELECT tax_coding.* FROM tax_coding WHERE tax_coding.type = 'group' ";

		$result['coding'] = \dash\pdo::get($query);

		return $result;

	}





}
?>