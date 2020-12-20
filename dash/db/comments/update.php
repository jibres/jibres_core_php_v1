<?php
namespace dash\db\comments;


class update
{

	public static function update($_args, $_id)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");
		$set    = \dash\db\config::make_set($_args);
		$query  = "UPDATE comments SET $set WHERE comments.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>