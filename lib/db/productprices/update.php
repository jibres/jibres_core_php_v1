<?php
namespace lib\db\productprices;


class update
{
	/**
	 * Update record of produc category
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function record()
	{
		$result = \dash\db\config::public_update('productprices', ...func_get_args());
		return $result;
	}
}
?>
