<?php
namespace dash\db\transactions;


class update
{

	public static function record($_args, $_id)
	{
		$set    = \dash\db\config::make_set($_args);
		$query  = "UPDATE transactions SET $set WHERE transactions.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>