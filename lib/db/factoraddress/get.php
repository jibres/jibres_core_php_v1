<?php
namespace lib\db\factoraddress;


class get
{


	/**
	 * Insert new record to product category table
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function by_factor_id($_factor_id)
	{
		$query = "SELECT * FROM factoraddress WHERE factoraddress.factor_id = $_factor_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

}
?>
