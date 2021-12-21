<?php
namespace lib\db\discount;


class update
{

	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE discount SET $set WHERE discount.id = $_id LIMIT 1";
			$result = \dash\pdo::query($query, []);
			return $result;
		}
	}

}
?>
