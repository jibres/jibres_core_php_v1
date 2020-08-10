<?php
namespace lib\db\tax_coding;


class update
{

	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE tax_coding SET $set WHERE tax_coding.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}

	public static function update_class($_value, $_id)
	{
		$query = "UPDATE tax_coding SET tax_coding.class = '$_value' WHERE tax_coding.parent1 = $_id";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function update_topic($_value, $_id)
	{
		$query = "UPDATE tax_coding SET tax_coding.topic = '$_value' WHERE tax_coding.parent2 = $_id";
		$result = \dash\db::query($query);
		return $result;
	}


}
?>
