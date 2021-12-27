<?php
namespace lib\db\tax_coding;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('tax_coding', $_args, $_id);
	}

	public static function update_class($_value, $_id)
	{
		$query = "UPDATE tax_coding SET tax_coding.class = '$_value' WHERE tax_coding.parent1 = $_id";
		$result = \dash\pdo::query($query, []);
		return $result;
	}

	public static function update_topic($_value, $_id)
	{
		$query = "UPDATE tax_coding SET tax_coding.topic = '$_value' WHERE tax_coding.parent2 = $_id";
		$result = \dash\pdo::query($query, []);
		return $result;
	}


}
?>
