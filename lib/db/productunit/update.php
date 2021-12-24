<?php
namespace lib\db\productunit;


class update
{
	/**
	 * Update record of produc category
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function record()
	{
		$result = \dash\pdo\query_template::update('productunit', ...func_get_args());
		return $result;
	}
}
?>
