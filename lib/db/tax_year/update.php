<?php
namespace lib\db\tax_year;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('tax_year', $_args, $_id);
	}

	public static function update_class($_value, $_id)
	{
		$query = "UPDATE tax_year SET tax_year.class = '$_value' WHERE tax_year.parent1 = $_id";
		$result = \dash\pdo::query($query, []);
		return $result;
	}

	public static function update_topic($_value, $_id)
	{
		$query = "UPDATE tax_year SET tax_year.topic = '$_value' WHERE tax_year.parent2 = $_id";
		$result = \dash\pdo::query($query, []);
		return $result;
	}


	public static function set_default($_id)
	{
		$query = "UPDATE tax_year SET tax_year.isdefault = NULL WHERE 1";
		$result = \dash\pdo::query($query, []);

		$query = "UPDATE tax_year SET tax_year.isdefault = 1 WHERE tax_year.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}


}
?>
