<?php
namespace lib\db\tax_document;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM tax_document WHERE tax_document.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function parent_list_details()
	{
		$query = "SELECT * FROM tax_document WHERE tax_document.type = 'assistant'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function parent_list_total()
	{
		$query = "SELECT * FROM tax_document WHERE tax_document.type = 'group'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function parent_list_assistant()
	{
		$query = "SELECT * FROM tax_document WHERE tax_document.type = 'total'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function check_parent_not_use($_id)
	{
		$query = "SELECT * FROM tax_document WHERE tax_document.parent1 = $_id OR tax_document.parent2 = $_id OR tax_document.parent3 = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


}
?>
