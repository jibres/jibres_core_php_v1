<?php
namespace lib\app\product;

trait import
{

	/**
	 * { function_description }
	 *
	 * @param      <type>  $_array  The array
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function xTrim($_array)
	{
		return array_map(function($_a){return trim(trim($_a), '"');}, $_array);
	}


	/**
	 * convert string to lower
	 *
	 * @param      <type>  $_array  The array
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function xStrToLower($_array)
	{
		return array_map(function($_a){return mb_strtolower($_a);}, $_array);
	}


	/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	public static function import($_string)
	{

		if(!\lib\user::id())
		{
			return false;
		}

		if(!\lib\store::id())
		{
			return false;
		}

		if(!is_string($_string))
		{
			return false;
		}

		$raw_data = \dash\utility\import::csv($_string);

		$result = [];

		foreach ($raw_data as $column => $data)
		{
			$result [] = \lib\app\product::add($data, ['debug' => false]);
		}

		return $result;
	}
}
?>