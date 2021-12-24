<?php
namespace dash\pdo;


class tools
{
	/**
	 * get multi insert id
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	public static function multi_insert_id($_args, $_first_id = null)
	{
		if($_first_id && is_int($_first_id))
		{
			$first = $_first_id;
		}
		else
		{
			$first = \dash\pdo::insert_id();
		}

		$count = count($_args);
		$ids = [];
		for ($i = $first; $i <= ($first + $count) - 1 ; $i++)
		{
			$ids[] = $i;
		}
		return $ids;
	}
}
?>