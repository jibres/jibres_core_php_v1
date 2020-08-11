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
}
?>
