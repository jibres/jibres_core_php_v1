<?php
namespace lib\db\form_filter;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('form_filter', $_args, $_id);
	}

	public static function update_filter_where($_args, $_id)
	{
		return \dash\pdo\query_template::update('form_filter_where', $_args, $_id);
	}


	public static function set_sort($_item_id, $_sort)
	{
		$query = [];
		foreach ($_sort as $key => $value)
		{
			$query[]  = " UPDATE form_filter SET form_filter.sort = $key WHERE form_filter.id = $value LIMIT 1";
		}

		$query = implode(';', $query);
		$result = \dash\pdo::query($query, [], null, ['multi_query' => true]);
		return $result;

	}

}
?>
