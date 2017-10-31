<?php
namespace lib\app\staff;
use \lib\debug;

trait get
{


	/**
	 * Gets the staff.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The staff.
	 */
	public static function get($_args)
	{
		\lib\app::valiable($_args);

		$default_options =
		[
			'debug' => true,
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

		if($_options['debug'])
		{
			debug::title(T_("Operation Faild"));
		}

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
			// return false;
		}

		$id = \lib\app::request("id");
		$id = \lib\utility\shortURL::decode($id);

		$shortname = \lib\app::request('shortname');

		if(!$id && !$shortname)
		{
			if($_options['debug'])
			{
				\lib\app::log('api:staff:id:shortname:not:set', \lib\user::id(), $log_meta);
				debug::error(T_("Store id or shortname not set"), 'id', 'arguments');
			}
			return false;
		}

		if($id && $shortname)
		{
			\lib\app::log('api:staff:id:shortname:together:set', \lib\user::id(), $log_meta);
			if($_options['debug'])
			{
				debug::error(T_("Can not set staff id and shortname together"), 'id', 'arguments');
			}
			return false;
		}

		if($id)
		{
			$result = \lib\db\staffs::access_staff_id($id, \lib\user::id(), ['action' => 'view']);
		}
		else
		{
			$result = \lib\db\staffs::access_staff($shortname, \lib\user::id(), ['action' => 'view']);
		}

		if(!$result)
		{
			if($id)
			{
				$result = \lib\db\staffs::get(['id' => $id, 'limit' => 1]);
			}
			elseif($shortname)
			{
				$result = \lib\db\staffs::get(['shortname' => $shortname, 'limit' => 1]);
			}

			if($result)
			{
				if(\lib\permission::access('load:all:staff', null, \lib\user::id()))
				{
					$result = $result;
				}
				else
				{
					\lib\temp::set('staff_access_denied', true);
					\lib\temp::set('staff_exist', true);
					$result = false;
				}
			}
		}

		if(!$result)
		{
			\lib\app::log('api:staff:access:denide', \lib\user::id(), $log_meta);
			if($_options['debug'])
			{
				debug::error(T_("Can not access to load this staff details"), 'staff', 'permission');
			}
			return false;
		}

		if($_options['debug'])
		{
			debug::title(T_("Operation complete"));
		}

		$result = self::ready($result);

		return $result;
	}
}
?>