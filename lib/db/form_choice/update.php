<?php
namespace lib\db\form_choice;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('form_choice', $_args, $_id);
	}


	public static function set_sort($_item_id, $_sort)
	{
		$query = [];
		foreach ($_sort as $key => $value)
		{
			$query[]  = " UPDATE form_choice SET form_choice.sort = $key WHERE form_choice.id = $value LIMIT 1";
		}

		$query = implode(';', $query);
		$result = \dash\pdo::query($query, [], null, ['multi_query' => true]);
		return $result;

	}

}
?>
