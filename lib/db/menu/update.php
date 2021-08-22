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



	public static function update_related_url_social($_social_network, $_url)
	{
		$query  = "UPDATE menu SET menu.url = '$_url' WHERE menu.pointer = 'socialnetwork' AND menu.socialnetwork = '$_social_network' ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function update_related_url($_pointer, $_related_id, $_url)
	{
		$query  = "UPDATE menu SET menu.url = '$_url' WHERE menu.pointer = '$_pointer' AND menu.related_id = $_related_id ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function sort_raw($_update, $_id)
	{
		$query = [];
		foreach ($_update as $sort => $id)
		{
			$query[] = "UPDATE menu SET menu.sort = $sort WHERE menu.id = $id AND menu.parent1 = $_id LIMIT 1";
		}

		if(!empty($query))
		{
			\dash\db::query(implode(' ; ', $query), null, ['multi_query' => true]);
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
