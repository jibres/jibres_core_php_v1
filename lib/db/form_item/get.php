<?php
namespace lib\db\form_item;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM form_item WHERE form_item.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function by_form_id($_form_id)
	{
		$query = "SELECT * FROM form_item WHERE form_item.form_id = $_form_id AND (form_item.status IS NULL OR form_item.status != 'deleted') ORDER BY IFNULL(form_item.sort, form_item.id) ASC ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function item_id_form_id($_ids, $_form_id)
	{
		$query = "SELECT * FROM form_item WHERE form_item.form_id = $_form_id AND form_item.id IN ($_ids) ";
		$result = \dash\db::get($query);
		return $result;

	}


	public static function get_by_id_form_id($_id, $_form_id)
	{
		$query = "SELECT * FROM form_item WHERE form_item.form_id = $_form_id AND form_item.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


}
?>
