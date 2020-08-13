<?php
namespace lib\db\tax_year;


class update
{

	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE tax_year SET $set WHERE tax_year.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}

	public static function update_class($_value, $_id)
	{
		$query = "UPDATE tax_year SET tax_year.class = '$_value' WHERE tax_year.parent1 = $_id";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function update_topic($_value, $_id)
	{
		$query = "UPDATE tax_year SET tax_year.topic = '$_value' WHERE tax_year.parent2 = $_id";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function set_default($_id)
	{
		$query = "UPDATE tax_year SET tax_year.isdefault = NULL WHERE 1";
		$result = \dash\db::query($query);

		$query = "UPDATE tax_year SET tax_year.isdefault = 1 WHERE tax_year.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


}
?>
