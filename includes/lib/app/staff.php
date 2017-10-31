<?php
namespace lib\app;
use \lib\utility;
use \lib\debug;

/**
 * Class for staff.
 */
class staff
{

	use staff\add;
	use staff\edit;
	use staff\datalist;
	use staff\get;


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check()
	{
		return \lib\app\user::check(...func_get_args());
	}


	/**
	 * ready data of store to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		return \lib\app\user::ready(...func_get_args());
	}

}
?>