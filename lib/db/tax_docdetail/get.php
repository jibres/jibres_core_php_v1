<?php
namespace lib\db\tax_docdetail;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM tax_docdetail WHERE tax_docdetail.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function parent_list_details()
	{
		$query = "SELECT * FROM tax_docdetail WHERE tax_docdetail.type = 'assistant'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function parent_list_total()
	{
		$query = "SELECT * FROM tax_docdetail WHERE tax_docdetail.type = 'group'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function parent_list_assistant()
	{
		$query = "SELECT * FROM tax_docdetail WHERE tax_docdetail.type = 'total'";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function check_parent_not_use($_id)
	{
		$query = "SELECT * FROM tax_docdetail WHERE tax_docdetail.parent1 = $_id OR tax_docdetail.parent2 = $_id OR tax_docdetail.parent3 = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


}
?>
