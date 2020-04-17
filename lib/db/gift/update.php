<?php
namespace lib\db\gift;


class update
{
	public static function update($_args, $_id)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE gift SET $set WHERE gift.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>