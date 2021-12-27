<?php
namespace lib\db\form_item;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('form_item', $_args, $_id);
	}


	public static function set_sort($_form_id, $_sort)
	{
		$query = [];
		foreach ($_sort as $key => $value)
		{
			$query[]  = " UPDATE form_item SET form_item.sort = $key WHERE form_item.id = $value AND form_item.form_id = $_form_id LIMIT 1";
		}

		$query = implode(';', $query);
		$result = \dash\pdo::query($query, [], null, ['multi_query' => true]);
		return $result;

	}

}
?>
