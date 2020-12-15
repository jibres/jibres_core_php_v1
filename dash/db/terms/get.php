<?php
namespace dash\db\terms;

class get
{
	public static function check_duplicate_url_in_terms($_url, $_id = null)
	{
		$check_id = null;
		if($_id)
		{
			$check_id = " AND terms.id != $_id ";
		}

		$query  = "SELECT * FROM terms WHERE terms.url = '$_url' $check_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT terms.*, (SELECT COUNT(*) FROM termusages WHERE termusages.term_id = terms.id) AS `count` FROM terms WHERE terms.id = $_id LIMIT 1 ";

		$result = \dash\db::get($query, null, true);

		return $result;
	}
}
?>