<?php
namespace lib\db\form_choice;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM form_choice WHERE form_choice.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function by_form_id($_form_id)
	{
		$query = "SELECT * FROM form_choice WHERE form_choice.form_id = $_form_id AND (form_choice.status IS NULL OR form_choice.status != 'deleted') ORDER BY IFNULL(form_choice.sort, form_choice.id) ASC ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function item_id_form_id($_ids, $_form_id)
	{
		$query = "SELECT * FROM form_choice WHERE form_choice.form_id = $_form_id AND form_choice.id IN ($_ids) ";
		$result = \dash\db::get($query);
		return $result;

	}


	public static function get_by_item_id($_item_id)
	{
		$query = "SELECT * FROM form_choice WHERE form_choice.item_id = $_item_id ORDER BY form_choice.sort ASC, form_choice.id ASC";
		$result = \dash\db::get($query);
		return $result;
	}


}
?>
