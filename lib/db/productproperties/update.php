<?php
namespace lib\db\productproperties;


class update
{
	/**
	 * Update record of produc category
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function record()
	{
		$result = \dash\db\config::public_update('productproperties', ...func_get_args());
		return $result;
	}


	public static function unset_outstanding($_id)
	{
		$query = "UPDATE productproperties SET productproperties.outstanding = NULL WHERE productproperties.id = $_id LIMIT 1 ";
		return \dash\db::query($query);
	}

	public static function set_outstanding($_id)
	{
		$query = "UPDATE productproperties SET productproperties.outstanding = 1 WHERE productproperties.id = $_id LIMIT 1 ";
		return \dash\db::query($query);
	}


	public static function group_title($_old, $_new, $_id)
	{
		$query = "UPDATE productproperties SET productproperties.cat = '$_new' WHERE productproperties.product_id = $_id AND productproperties.cat = '$_old' ";
		return \dash\db::query($query);
	}
}
?>
