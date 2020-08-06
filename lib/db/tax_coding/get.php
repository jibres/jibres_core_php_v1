<?php
namespace lib\db\tax_coding;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function parent_list_details()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.type = 'assistant'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function parent_list_total()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.type = 'group'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function parent_list_assistant()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.type = 'total'";
		$result = \dash\db::get($query);
		return $result;
	}



	public static function list_assistant()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.type = 'assistant'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function list_details()
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.type = 'details'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function check_parent_not_use($_id)
	{
		$query = "SELECT * FROM tax_coding WHERE tax_coding.parent1 = $_id OR tax_coding.parent2 = $_id OR tax_coding.parent3 = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


}
?>
