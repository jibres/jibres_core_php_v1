<?php
namespace lib\db\form_filter;


class delete
{


	public static function delete_where_by_filter_id($_id)
	{
		$query  = "DELETE FROM form_filter_where WHERE form_filter_where.filter_id = $_id ";
		$result = \dash\db::query($query);
		return $result;

	}

	public static function by_id($_id)
	{
		$query  = "DELETE FROM form_filter WHERE form_filter.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;

	}

	public static function delete_where_id($_id)
	{
		$query  = "DELETE FROM form_filter_where WHERE form_filter_where.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
