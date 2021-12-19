<?php
namespace dash\db\tickets;

class update
{

	public static function update($_args, $_id)
	{
		$set    = \dash\db\config::make_set($_args);
		$query  = "UPDATE tickets SET $set WHERE tickets.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function assing_to_user($_guest_id, $_user_id)
	{
		$query  = "UPDATE tickets SET tickets.user_id = $_user_id, tickets.guestid = NULL WHERE tickets.guestid = '$_guest_id' ";
		$result = \dash\db::query($query);
	}


	public static function set_base_null($_base_id)
	{
		$query  = "UPDATE tickets SET tickets.base = NULL WHERE tickets.base = $_base_id ";
		$result = \dash\db::query($query);

		$query  = "UPDATE tickets SET tickets.branch = NULL WHERE tickets.branch = $_base_id ";
		$result = \dash\db::query($query);
	}



	public static function set_assing($_new_user_id, $_ticket_id)
	{
		$query  = "UPDATE tickets SET tickets.user_id = $_new_user_id WHERE tickets.id = $_ticket_id LIMIT 1 ";
		$result = \dash\db::query($query);

		$query  = "UPDATE tickets SET tickets.user_id = $_new_user_id WHERE tickets.parent = $_ticket_id AND tickets.user_id IS NULL ";
		$result = \dash\db::query($query);
	}



	public static function close_solved_ticket()
	{
		$yesterday = date("Y-m-d H:i:s", strtotime('-1 days'));
		$get_count =
		"
			SELECT COUNT(*) AS `count` FROM tickets
			WHERE
				tickets.solved = 1 AND
				tickets.parent IS NULL AND
				tickets.status IN ('answered', 'awaiting') AND
				tickets.datemodified < '$yesterday'
		";

		$count = \dash\db::get($get_count, 'count', true);
		if($count)
		{
			\dash\log::set('ticket_AutoCloseSolvedTicket', ['count' => $count]);
		}

		$query =
		"
			UPDATE tickets
			SET tickets.status = 'close'
			WHERE
				tickets.solved = 1 AND
				tickets.parent IS NULL AND
				tickets.status IN ('answered', 'awaiting') AND
				tickets.datemodified < '$yesterday'
		";
		\dash\db::query($query);

	}

	public static function spam_by_block_ip()
	{
		// @todo @reza need to fix
		return false;

		$block_ip = null;

		if(is_array($block_ip) && $block_ip)
		{
			$ips = implode(',', $block_ip);

			$get_count =
			"
				SELECT COUNT(*) AS `count` FROM comments
				WHERE
					comments.status NOT IN ('spam') AND
					comments.ip IN ($ips)
			";

			$count = \dash\db::get($get_count, 'count', true);

			if($count)
			{
				\dash\log::set('ticket_AutoSpamTicketByIp', ['count' => $count]);
			}

			$query =
			"
				UPDATE comments
				SET comments.status = 'spam'
				WHERE
					comments.status NOT IN ('spam') AND
					comments.ip IN ($ips)
			";
			\dash\db::query($query);
		}

	}


}
?>