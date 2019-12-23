<?php
namespace lib\db\productcompany;


class update
{
	/**
	 * Update record of produc category
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function record()
	{
		$result = \dash\db\config::public_update('productcompany', ...func_get_args());
		return $result;
	}
}
?>
