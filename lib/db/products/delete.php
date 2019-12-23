<?php
namespace lib\db\products;

class delete
{

	/**
	 * delete one product by id
	 *
	 * @param      <type>   $_id    The identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function record($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$query = "DELETE FROM products WHERE id = $_id LIMIT 1";
		return \dash\db::query($query);
	}
}
?>