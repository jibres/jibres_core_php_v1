<?php
namespace lib\db\tax_coding;


class get
{
	public static function get_count_group()
	{
		$query = "SELECT COUNT(*) AS `count`, tax_coding.type FROM tax_coding GROUP BY tax_coding.type";
		$result = \dash\db::get($query, ['type', 'count'], true);
		return $result;
	}
	public static function check_duplicate_title($_where)
	{
		$make_where = \dash\db\config::make_where($_where);
		$query = "SELECT * FROM tax_coding WHERE $make_where LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function list_tree()
	{
		$query = "SELECT * FROM tax_coding WHERE 1";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function last_code_assistant($_assistant_id)
	{
		$query = "SELECT MAX(tax_coding.code) AS `code` FROM tax_coding WHERE tax_coding.type = 'details' AND tax_coding.parent3 = $_assistant_id";
		$result = \dash\db::get($query, 'code', true);
		return $result;
	}

	public static function by_code($_code)
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.code = $_code LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_id($_id)
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function parent_list_details()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.type = 'assistant'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function parent_list_total()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.type = 'group'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function parent_list_assistant()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.type = 'total'";
		$result = \dash\db::get($query);
		return $result;
	}



	public static function list_group()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.type = 'group'";
		$result = \dash\db::get($query);
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
		$result = \dash\db::get($query);
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
		$result = \dash\db::get($query);

		return $result;
	}


	public static function list_details()
	{
		$query = "SELECT DISTINCT tax_coding.title FROM tax_coding WHERE tax_coding.type = 'details'";
		$result = \dash\db::get($query, 'title');
		return $result;
	}


	public static function check_parent_not_use($_id)
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.parent1 = $_id OR tax_coding.parent2 = $_id OR tax_coding.parent3 = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function by_title_assistant_id($_title, $_parent1, $_parent2, $_parent3)
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.title = '$_title' AND tax_coding.parent1 = $_parent1 AND tax_coding.parent2 = $_parent2 AND tax_coding.parent3 = $_parent3  AND tax_coding.type = 'details' LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


}
?>
