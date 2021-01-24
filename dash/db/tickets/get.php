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
			ORDER BY tickets.id ASC
			LIMIT 500
		";

		$result = \dash\db::get($query);

		return $result;
	}


	public static function get($_id)
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
				tickets.id = $_id
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true);

		return $result;
	}

	public static function load_my_ticket($_id, $_user_id)
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
				tickets.id = $_id AND
				tickets.user_id = $_user_id
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true);

		return $result;
	}



	public static function conversation_count($_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM tickets WHERE tickets.parent = $_id OR tickets.id = $_id ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}



}
?>