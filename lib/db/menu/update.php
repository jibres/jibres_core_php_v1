<?php
namespace lib\db\menu;


class update
{

	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE menu SET $set WHERE menu.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}


	public static function sort_level($_update)
	{
		$query = [];
		foreach ($_update as $id => $set)
		{
			$make_set = \dash\db\config::make_set($set);
			if($make_set)
			{
				$query[] = "UPDATE menu SET $make_set WHERE menu.id = $id LIMIT 1";
			}
		}

		if(!empty($query))
		{
			\dash\db::query(implode(' ; ', $query), null, ['multi_query' => true]);
		}

	}

}
?>
