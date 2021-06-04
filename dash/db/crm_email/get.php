<?php
namespace dash\db\crm_email;


class get
{


	public static function by_id($_id)
	{
		$query = "SELECT * FROM crm_email WHERE crm_email.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>
