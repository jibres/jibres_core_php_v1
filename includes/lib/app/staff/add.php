<?php
namespace lib\app\staff;
use \lib\utility;
use \lib\debug;

trait add
{

	/**
	 * add new staff
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args = [])
	{
		\lib\app::variable($_args);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \lib\app::request(),
			]
		];

		if(!\lib\user::id())
		{
			\lib\app::log('api:staff:user_id:notfound', null, $log_meta);
			debug::error(T_("User not found"), 'user');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\lib\debug::$status)
		{
			return false;
		}

		$return = [];

		$staff_id = \lib\app\user::add($args);

		if(!$staff_id)
		{
			\lib\app::log('api:staff:no:way:to:insert:staff', \lib\user::id(), $log_meta);
			debug::error(T_("No way to insert staff"), 'db', 'system');
			return false;
		}

		$return['staff_id'] = \lib\utility\shortURL::encode($staff_id);

		if(debug::$status)
		{
			debug::true(T_("Staff successfuly added"));
		}

		return $return;
	}
}
?>