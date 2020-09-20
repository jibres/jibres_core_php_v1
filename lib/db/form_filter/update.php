<?php
namespace lib\db\form_filter;


class update
{

	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE form_filter SET $set WHERE form_filter.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}

	public static function update_filter_where($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE form_filter_where SET $set WHERE form_filter_where.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}


	public static function set_sort($_item_id, $_sort)
	{
		$query = [];
		foreach ($_sort as $key => $value)
		{
			$query[]  = " UPDATE form_filter SET form_filter.sort = $key WHERE form_filter.id = $value LIMIT 1";
		}

		$query = implode(';', $query);
		$result = \dash\db::query($query, null, ['multi_query' => true]);
		return $result;

	}

}
?>
