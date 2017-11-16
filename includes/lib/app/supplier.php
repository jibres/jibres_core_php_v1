<?php
namespace lib\app;


class supplier
{

	use \lib\app\supplier\add;
	use \lib\app\supplier\datalist;
	use \lib\app\supplier\edit;
	use \lib\app\supplier\get;

	/**
	 * type of users
	 * supplier
	 * costomer
	 * suplier
	 *
	 * @var        string
	 */
	public static $type = 'supplier';


	/**
	 * check some variable to be true
	 *
	 * @param      array    $_option  The option
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function check($_option = [])
	{
		return \lib\app\user::check(...func_get_args());
	}
}
?>
