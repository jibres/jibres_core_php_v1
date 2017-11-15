<?php
namespace lib\app;


class customer
{

	use \lib\app\customer\add;
	use \lib\app\customer\datalist;
	use \lib\app\customer\edit;
	use \lib\app\customer\get;

	/**
	 * type of users
	 * customer
	 * costomer
	 * suplier
	 *
	 * @var        string
	 */
	public static $type = 'customer';


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
				\lib\app::log('app:customer:firstname:cannot:null:'. self::$type , \lib\user::id());
				\lib\debug::error(T_("Firstname or Lastname of customer can not be null"), ['firstname', 'lastname']);
				return false;
			}
		}

		if(\lib\app::isset_request('birthday') && \lib\app::request('birthday'))
		{
			$birthday = \lib\utility\human::number(\lib\app::request('birthday'), 'en');
			if(strtotime($birthday) === false)
			{
				\lib\app::log('app:customer:invalid:birthday:'. self::$type , \lib\user::id());
				\lib\debug::error(T_("birthday is incorrect"), 'birthday');
				return false;
			}
		}

		return \lib\app\user::check(...func_get_args());
	}
}
?>
