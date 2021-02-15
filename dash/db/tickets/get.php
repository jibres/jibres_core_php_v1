<?php
namespace dash\db\tickets;

class get
{
	public static function count_unanswered_ticket()
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				tickets
			WHERE
				tickets.parent  IS NULL AND
				tickets.status = 'awaiting'
		";

		$result = \dash\db::get($query, 'count', true);
		return $result;

	}


	public static function count_user_ticket($_user_id)
	{

		$get_count =
		"
			SELECT COUNT(*) AS `count` FROM tickets
			WHERE
				tickets.status NOT IN ('deleted', 'spam') AND
				tickets.parent IS NULL AND
				(tickets.solved = 0 OR tickets.solved IS NULL) AND
				tickets.user_id = $_user_id
		";

		$count = \dash\db::get($get_count, 'count', true);
		return $count;

	}



	public static function last_ticket_message_id($_ticket_id, $_fuel, $_db_name)
	{
		$query =
		"
			SELECT
				tickets.id,
				tickets.status
			FROM
				tickets
			WHERE
				tickets.parent = $_ticket_id OR tickets.id = $_ticket_id
			ORDER BY tickets.id DESC
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true, $_fuel, ['database' => $_db_name]);
		return $result;

	}



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
			ORDER BY tickets.id DESC
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



	public static function avg_answertime()
	{
		$query = "SELECT AVG(tickets.answertime) AS `answertime` FROM tickets WHERE tickets.status NOT IN ('deleted', 'spam') AND tickets.parent IS NULL AND tickets.answertime IS NOT NULL ";
		$result = \dash\db::get($query, 'answertime', true);
		return floatval($result);
	}



	public static function chart_by_date_fa($_enddate, $_month_list, $_message = false)
	{
		$CASE = [];
		foreach ($_month_list as $month => $date)
		{
			$CASE[] = "WHEN tickets.datecreated >= '$date[0] 00:00:00' AND tickets.datecreated <= '$date[1] 23:59:59' THEN '$month'";
		}

		$CASE = " CASE ". implode(" ", $CASE). "  ELSE '0' END ";

		$where = ' AND tickets.parent IS NULL ';
		if($_message)
		{
			$where = null;
		}

		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				$CASE AS `month`
			FROM
				tickets
			WHERE
				tickets.datecreated >= '$_enddate'
				$where
			GROUP BY $CASE
		";
		$result = \dash\db::get($query, ['month', 'count']);
		return $result;
	}



	public static function chart_by_date_en($_enddate, $_message = false)
	{
		$where = ' AND tickets.parent IS NULL ';
		if($_message)
		{
			$where = null;
		}

		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				MONTH(tickets.datecreated) AS `month`
			FROM
				tickets
			WHERE
				tickets.datecreated >= '$_enddate'
				$where

			GROUP BY MONTH(tickets.datecreated)
		";

		$result = \dash\db::get($query, ['month', 'count']);

		return $result;
	}





}
?>