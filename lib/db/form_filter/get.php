<?php
namespace lib\db\form_filter;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM form_filter WHERE form_filter.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function by_form_id($_form_id)
	{
		$query = "SELECT * FROM form_filter WHERE form_filter.form_id = $_form_id ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function item_id_form_id($_ids, $_form_id)
	{
		$query = "SELECT * FROM form_filter WHERE form_filter.form_id = $_form_id AND form_filter.item_id IN ($_ids) ORDER BY form_filter.sort ASC, form_filter.id ASC ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function get_by_item_id($_item_id)
	{
		$query = "SELECT * FROM form_filter WHERE form_filter.item_id = $_item_id ORDER BY form_filter.sort ASC, form_filter.id ASC";
		$result = \dash\db::get($query);
		return $result;
	}



	public static function where_list_filter_id($_filter_id)
	{
		$query = "SELECT * FROM form_filter_where WHERE form_filter_where.filter_id = $_filter_id ";
		$result = \dash\db::get($query);
		return $result;
	}


}
?>
