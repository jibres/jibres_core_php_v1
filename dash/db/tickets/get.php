<?php
namespace dash\db\tickets;

class get
{
	public static function conversation($_id, $_customer_mode = false)
	{
		$note = null;
		if($_customer_mode)
		{
			$note = " AND tickets.type != 'note' ";
		}
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
				(tickets.parent = $_id OR tickets.id = $_id)  $note
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




	public static function load_my_ticket_guestid($_id, $_guestid)
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
				tickets.guestid = '$_guestid'
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



	public static function count_awaiting()
	{
		$query = "SELECT COUNT(*) AS `count` FROM tickets WHERE tickets.parent IS NULL AND tickets.status = 'awaiting' ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}


	public static function count_ticket()
	{
		$query = "SELECT COUNT(*) AS `count` FROM tickets WHERE tickets.parent IS NULL AND tickets.status NOT IN ('deleted', 'spam') ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}


	public static function count_message()
	{
		$query = "SELECT COUNT(*) AS `count` FROM tickets WHERE tickets.status NOT IN ('deleted', 'spam') ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}


	public static function count_close()
	{
		$query = "SELECT COUNT(*) AS `count` FROM tickets WHERE tickets.parent IS NULL AND tickets.status = 'close' ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}


	public static function count_solved()
	{
		$query = "SELECT COUNT(*) AS `count` FROM tickets WHERE  tickets.status NOT IN ('deleted', 'spam') AND tickets.parent IS NULL AND tickets.solved = 1 ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}


	public static function count_unsolved()
	{
		$query = "SELECT COUNT(*) AS `count` FROM tickets WHERE tickets.status NOT IN ('deleted', 'spam') AND tickets.parent IS NULL AND (tickets.solved = 0 OR tickets.solved IS NULL) ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}





}
?>