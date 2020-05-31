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
}
?>
