<?php
namespace lib\db\form_choice;


class update
{

	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE form_choice SET $set WHERE form_choice.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}


	public static function set_sort($_item_id, $_sort)
	{
		$query = [];
		foreach ($_sort as $key => $value)
		{
			$query[]  = " UPDATE form_choice SET form_choice.sort = $key WHERE form_choice.id = $value LIMIT 1";
		}

		$query = implode(';', $query);
		$result = \dash\db::query($query, null, ['multi_query' => true]);
		return $result;

	}

}
?>
