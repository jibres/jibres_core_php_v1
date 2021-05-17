<?php
namespace lib\db\productcategory;


class update
{
	/**
	 * Update record of produc category
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function record()
	{
		$result = \dash\db\config::public_update('productcategory', ...func_get_args());
		return $result;
	}


	public static function unset_file($_id)
	{
		$query  = "UPDATE productcategory SET productcategory.file = NULL WHERE productcategory.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function first_level($_id)
	{
		$query  =
		"
			UPDATE
				productcategory
			SET
				productcategory.parent1 = NULL,
				productcategory.parent2 = NULL,
				productcategory.parent3 = NULL,
				productcategory.parent4 = NULL,
				productcategory.firstlevel = NULL
			WHERE

				productcategory.id = $_id OR
				productcategory.parent1 = $_id OR
				productcategory.parent2 = $_id OR
				productcategory.parent3 = $_id OR
				productcategory.parent4 = $_id

		";
		$result = \dash\db::query($query);
		return $result;
	}



	public static function set_first_level($_id, $_sort)
	{
		self::first_level($_id);

		$query  =
		"
			UPDATE
				productcategory
			SET
				productcategory.firstlevel = 1,
				productcategory.sort = $_sort
			WHERE
				productcategory.id = $_id
			LIMIT 1
		";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function set_sort($_sort)
	{
		$query = [];
		foreach ($_sort as $sort => $id)
		{
			$query[] = "UPDATE productcategory SET productcategory.sort = $sort WHERE productcategory.id = $id LIMIT 1 ";
		}

		$result = \dash\db::query(implode(';', $query), null, ['multi_query' => true]);
		return $result;
	}


	public static function sort_level($_update)
	{
		$query = [];
		foreach ($_update as $id => $set)
		{
			$make_set = \dash\db\config::make_set($set);
			if($make_set)
			{
				$query[] = "UPDATE productcategory SET $make_set WHERE productcategory.id = $id LIMIT 1";
			}
		}

		if(!empty($query))
		{
			\dash\db::query(implode(' ; ', $query), null, ['multi_query' => true]);
		}

	}
}
?>
