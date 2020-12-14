<?php
namespace dash\db\terms;

class get
{
	public static function by_id($_id)
	{
		$query = "SELECT terms.*, (SELECT COUNT(*) FROM termusages WHERE termusages.term_id = terms.id) AS `count` FROM terms WHERE terms.id = $_id LIMIT 1 ";

		$result = \dash\db::get($query, null, true);

		return $result;
	}
}
?>