<?php
namespace lib\db\tax_coding;


class get
{

	public static function have_any_coding()
	{
		$query = "SELECT tax_coding.* FROM tax_coding LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function all_to_assistant()
	{
		$query = "SELECT tax_coding.* FROM tax_coding WHERE tax_coding.type IN ('group', 'total', 'assistant') ";
		$result = \dash\pdo::get($query);
		return $result;
	}

	public static function all_child_id($_id)
	{
		$query = "SELECT tax_coding.id AS `id` FROM tax_coding WHERE tax_coding.id = $_id OR tax_coding.parent1 = $_id OR tax_coding.parent2 = $_id OR tax_coding.parent3 = $_id ";
		$result = \dash\pdo::get($query, [], 'id');
		return $result;
	}


	public static function all_child_id_group($_id)
	{
		$query = "SELECT tax_coding.id AS `id` FROM tax_coding WHERE tax_coding.id = $_id OR tax_coding.parent1 = $_id ";
		$result = \dash\pdo::get($query, [], 'id');
		return $result;
	}

	public static function all_child_id_total($_id, $_group_id)
	{
		$group = null;
		if($_group_id)
		{
			$group = " AND tax_coding.parent1 = $_group_id ";
		}

		$query = "SELECT tax_coding.id AS `id` FROM tax_coding WHERE (tax_coding.id = $_id OR tax_coding.parent2 = $_id ) $group ";
		$result = \dash\pdo::get($query, [], 'id');
		return $result;
	}



	public static function count_all()
	{
		$query = "SELECT COUNT(*) AS `count` FROM tax_coding ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}


	public static function get_count_group()
	{
		$query = "SELECT COUNT(*) AS `count`, tax_coding.type FROM tax_coding GROUP BY tax_coding.type";
		$result = \dash\pdo::get($query, [], ['type', 'count'], true);
		return $result;
	}

	public static function check_duplicate_title($_args)
	{

		$q  = \dash\pdo\prepare_query::generate_where('tax_coding', $_args);

		$query  = "SELECT * FROM tax_coding WHERE $q[where] LIMIT 1";
		$param  = $q['param'];
		$result = \dash\pdo::get($query, $param, null, true);

		return $result;

	}

	public static function list_tree()
	{
		$query = "SELECT * FROM tax_coding WHERE 1";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function last_code_assistant($_assistant_id)
	{
		$query = "SELECT MAX(tax_coding.code) AS `code` FROM tax_coding WHERE tax_coding.type = 'details' AND tax_coding.parent3 = $_assistant_id";
		$result = \dash\pdo::get($query, [], 'code', true);
		return $result;
	}

	public static function id_by_code($_code)
	{
		$query = "SELECT tax_coding.id FROM tax_coding WHERE tax_coding.code = $_code LIMIT 1";
		$result = \dash\pdo::get($query, [], 'id', true);

		if(!$result)
		{
			return null;
		}
		return $result;
	}

	public static function by_code($_code)
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.code = $_code LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function by_id($_id)
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

	public static function by_multi_id($_ids)
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.id IN ($_ids)";
		$result = \dash\pdo::get($query);
		return $result;
	}




	public static function parent_list_details()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.type = 'assistant'";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function parent_list_total()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.type = 'group'";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function parent_list_assistant()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.type = 'total'";
		$result = \dash\pdo::get($query);
		return $result;
	}



	public static function list_group()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.type = 'group'";
		$result = \dash\pdo::get($query);
		return $result;
	}

	public static function list_total()
	{
		$query =
		"
			SELECT
				tax_coding.*,
				(SELECT myTax_coding.title FROM tax_coding AS `myTax_coding` WHERE myTax_coding.id = tax_coding.parent1 LIMIT 1) AS `group_title`
			FROM
				tax_coding
			WHERE tax_coding.type = 'total'
		";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function list_total_raw($_group_id = null)
	{
		$group = null;
		if($_group_id)
		{
			$group = " AND tax_coding.parent1 = $_group_id ";
		}
		$query =
		"
			SELECT
				tax_coding.*

			FROM
				tax_coding
			WHERE tax_coding.type = 'total' $group
		";
		$result = \dash\pdo::get($query);
		return $result;
	}




	public static function list_assistant()
	{
		$query =
		"
			SELECT
				tax_coding.*,
				(SELECT myTax_coding.title FROM tax_coding AS `myTax_coding` WHERE myTax_coding.id = tax_coding.parent1 LIMIT 1) AS `group_title`,
				(SELECT myTax_coding.title FROM tax_coding AS `myTax_coding` WHERE myTax_coding.id = tax_coding.parent2 LIMIT 1) AS `total_title`
			FROM
				tax_coding
			WHERE tax_coding.type = 'assistant'
		";
		$result = \dash\pdo::get($query);

		return $result;
	}

	public static function list_assistant_raw($_group_id = null, $_total_id = null)
	{
		$group = null;
		if($_group_id)
		{
			$group = " AND tax_coding.parent1 = $_group_id ";
		}

		$total = null;
		if($_total_id)
		{
			$total = " AND tax_coding.parent2 = $_total_id ";
		}

		$query =
		"
			SELECT
				tax_coding.*
			FROM
				tax_coding
			WHERE tax_coding.type = 'assistant' $group $total
		";
		$result = \dash\pdo::get($query);

		return $result;
	}


	public static function list_details()
	{
		$query = "SELECT DISTINCT tax_coding.title FROM tax_coding WHERE tax_coding.type = 'details'";
		$result = \dash\pdo::get($query, [], 'title');
		return $result;
	}

	public static function list_details_raw()
	{
		$query =
		"
			SELECT
				tax_coding.*,
				(SELECT myTax_coding.title FROM tax_coding AS `myTax_coding` WHERE myTax_coding.id = tax_coding.parent1 LIMIT 1) AS `group_title`,
				(SELECT myTax_coding.title FROM tax_coding AS `myTax_coding` WHERE myTax_coding.id = tax_coding.parent2 LIMIT 1) AS `total_title`,
				(SELECT myTax_coding.title FROM tax_coding AS `myTax_coding` WHERE myTax_coding.id = tax_coding.parent3 LIMIT 1) AS `assistant_title`,
				tax_coding.title as `detail_title`
			FROM
				tax_coding
			WHERE tax_coding.type = 'details' ORDER BY tax_coding.code ASC
		";

		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function check_parent_not_use($_id)
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.parent1 = $_id OR tax_coding.parent2 = $_id OR tax_coding.parent3 = $_id LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

	public static function check_not_use($_id)
	{
		$query = "SELECT * FROM tax_docdetail WHERE tax_docdetail.assistant_id = $_id OR tax_docdetail.details_id = $_id LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function by_title_assistant_id($_title, $_parent1, $_parent2, $_parent3)
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.title = '$_title' AND tax_coding.parent1 = $_parent1 AND tax_coding.parent2 = $_parent2 AND tax_coding.parent3 = $_parent3  AND tax_coding.type = 'details' LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


}
?>
