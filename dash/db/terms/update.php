<?php
namespace dash\db\terms;

class update
{

	public static function update($_args, $_id)
	{
		$set    = \dash\db\config::make_set($_args);
		$query  = "UPDATE terms SET $set WHERE terms.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>