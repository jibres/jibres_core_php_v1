<?php
namespace lib\app;


class staff
{

	use \lib\app\staff\add;
	use \lib\app\staff\datalist;
	use \lib\app\staff\edit;
	use \lib\app\staff\get;

	/**
	 * type of users
	 * staff
	 * costomer
	 * supplier
	 *
	 * @var        string
	 */
	public static $type = 'staff';


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
				\lib\app::log('app:staff:firstname:cannot:null:'. self::$type , \lib\user::id());
				\lib\debug::error(T_("Firstname or Lastname of staff can not be null"), ['firstname', 'lastname']);
				return false;
			}
		}

		if(\lib\app::isset_request('birthday') && \lib\app::request('birthday'))
		{
			$birthday = \lib\utility\human::number(\lib\app::request('birthday'), 'en');
			if(strtotime($birthday) === false)
			{
				\lib\app::log('app:staff:invalid:birthday:'. self::$type , \lib\user::id());
				\lib\debug::error(T_("birthday is incorrect"), 'birthday');
				return false;
			}
		}

		return \lib\app\user::check(...func_get_args());
	}


	public static function ready($_data)
	{
		if(isset($_data['type']) && $_data['type'] === 'supplier')
		{
			if(array_key_exists('nationalcode', $_data))
			{
				$_data['mobile'] = $_data['nationalcode'];
			}
		}

		return \lib\app\user::ready($_data);
	}
}
?>
