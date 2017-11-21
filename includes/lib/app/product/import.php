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
		return array_map(function($_a){return trim($_a);}, $_array);
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

		$line        = explode("\n", $_string);
		$column_line = current($line);
		array_shift($line);
		$column      = explode(",", $column_line);
		$column      = self::xTrim($column);
		$column      = self::xStrToLower($column);

		if(!in_array('title', $column))
		{
			\lib\app::log('api:product:import:title:notfound', null, \lib\app::log_meta());
			debug::error(T_("Your file has not field 'title' "));
			return false;
		}

		$result = [];

		foreach ($line as $key => $value)
		{
			$data = explode(',', $value);
			if(count($column) === count($data))
			{
				$data      = self::xTrim($data);
				$insert    = array_combine($column, $data);
				$result [] = \lib\app\product::add($insert, ['debug' => false]);
			}
		}

		return $result;
	}



}
?>