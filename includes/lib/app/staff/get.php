<?php
namespace lib\app\staff;


trait get
{

	/**
	 * Gets the staff.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The staff.
	 */
	public static function get($_args, $_options = [])
	{
		\lib\app::variable($_args);

		$default_options =
		[
			'debug' => true,
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

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
			return false;
		}

		$id = \lib\app::request("id");
		$id = \lib\utility\shortURL::decode($id);
		if(!$id)
		{
			if($_options['debug'])
			{
				\lib\app::log('api:staff:id:shortname:not:set:'. self::$type , \lib\user::id(), $log_meta);
				\lib\debug::error(T_("Store id or shortname not set"), 'id', 'arguments');
			}
			return false;
		}

		$get_staff =
		[
			'id'       => $id,
			'store_id' => \lib\store::id(),
			'limit'    => 1,
		];

		$result = \lib\db\userstores::get($get_staff);

		if(!$result || !isset($result['user_id']))
		{
			\lib\app::log('api:staff:access:denide:'. self::$type , \lib\user::id(), $log_meta);
			if($_options['debug'])
			{
				\lib\debug::error(T_("Can not access to load this staff details"), self::$type, 'permission');
			}
			return false;
		}

		$_options['other_field']    = 'store_id';
		$_options['other_field_id'] = \lib\store::id();
		$_options['user_id']        = $result['user_id'];
		$_args['id']                = \lib\utility\shortURL::encode($result['user_id']);

		return \lib\app\user::get($_args, $_options);
	}

}
?>