<?php
namespace lib\db\form_tag;

class search
{






	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM form_tag $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				form_tag.*,
				(SELECT COUNT(*) FROM form_tagusage WHERE form_tagusage.form_tag_id = form_tag.id) AS `count`

			FROM form_tag $q[where] $q[order] $limit ";

		$result = \dash\db::get($query);

		return $result;
	}



}
?>