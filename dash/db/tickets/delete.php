<?php
namespace dash\db\tickets;

class delete
{

	public static function delete($_id)
	{
		$query  = "DELETE FROM tickets WHERE tickets.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>