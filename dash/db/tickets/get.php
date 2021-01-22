<?php
namespace dash\db\tickets;

class get
{
	public static function conversation($_id)
	{

		$query =
		"
			SELECT
				tickets.*,
				users.mobile      AS `mobile`,
				users.displayname AS `displayname`,
				users.avatar AS `avatar`
			FROM
				tickets
			LEFT JOIN users ON users.id = tickets.user_id
			WHERE
				tickets.parent = $_id OR tickets.id = $_id
			ORDER BY tickets.id DESC
			LIMIT 500
		";

		$result = \dash\db::get($query);

		return $result;
	}



}
?>