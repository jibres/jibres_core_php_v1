<?php
namespace lib\db\form_filter;


class delete
{

	public static function all_filter($_form_id)
	{
		$query  = "DELETE FROM form_filter_where WHERE form_filter_where.form_id = $_form_id ";
		$result = \dash\pdo::query($query, []);


		$query  = "DELETE FROM form_filter WHERE form_filter.form_id = $_form_id ";
		$result = \dash\pdo::query($query, []);

		return $result;
	}


	public static function delete_where_by_filter_id($_id)
	{
		$query  = "DELETE FROM form_filter_where WHERE form_filter_where.filter_id = $_id ";
		$result = \dash\pdo::query($query, []);
		return $result;

	}

	public static function by_id($_id)
	{
		$query  = "DELETE FROM form_filter WHERE form_filter.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;

	}

	public static function delete_where_id($_id)
	{
		$query  = "DELETE FROM form_filter_where WHERE form_filter_where.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}

}
?>
