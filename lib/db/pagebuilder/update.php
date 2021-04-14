<?php
namespace lib\db\pagebuilder;


class update
{

	public static function record($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE pagebuilder SET $set WHERE pagebuilder.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>
