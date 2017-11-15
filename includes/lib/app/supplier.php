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
		if(\lib\app::isset_request('firstname') && !trim(\lib\app::request('firstname')))
		{
			if(\lib\app::isset_request('lastname') && !trim(\lib\app::request('lastname')))
			{
				\lib\app::log('app:supplier:firstname:cannot:null:'. self::$type , \lib\user::id());
				\lib\debug::error(T_("Firstname or Lastname of :supplier can not be null", ['supplier' => T_(self::$type)]), ['firstname', 'lastname']);
				return false;
			}
		}

		if(\lib\app::isset_request('birthday') && \lib\app::request('birthday'))
		{
			$birthday = \lib\utility\human::number(\lib\app::request('birthday'), 'en');
			if(strtotime($birthday) === false)
			{
				\lib\app::log('app:supplier:invalid:birthday:'. self::$type , \lib\user::id());
				\lib\debug::error(T_("birthday is incorrect"), 'birthday');
				return false;
			}
		}

		return \lib\app\user::check(...func_get_args());
	}
}
?>
