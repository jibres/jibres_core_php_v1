<?php
namespace dash\db\csrf;



class update
{
	public static function set_used($_id)
	{
		$date = date("Y-m-d H:i:s");
		$query = "UPDATE csrf SET csrf.status = 'used', csrf.datemodified = '$date' WHERE csrf.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>