<?php
namespace lib\app\store;


trait get
{


	/**
	 * Gets the store.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The store.
	 */
	public static function get($_args)
	{
		\dash\app::valiable($_args);

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
			// \dash\notif::title(T_("Operation Faild"));
		}

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \dash\app::request(),
			]
		];

		if(!\dash\user::id())
		{
			// return false;
		}

		$id = \dash\app::request("id");
		$id = \dash\coding::decode($id);

		$shortname = \dash\app::request('shortname');

		if(!$id && !$shortname)
		{
			if($_options['debug'])
			{
				\dash\app::log('api:store:id:shortname:not:set', \dash\user::id(), $log_meta);
				\dash\notif::error(T_("Store id or shortname not set"), 'id', 'arguments');
			}
			return false;
		}

		if($id && $shortname)
		{
			\dash\app::log('api:store:id:shortname:together:set', \dash\user::id(), $log_meta);
			if($_options['debug'])
			{
				\dash\notif::error(T_("Can not set store id and shortname together"), 'id', 'arguments');
			}
			return false;
		}

		if($id)
		{
			$result = \lib\db\stores::access_store_id($id, \dash\user::id(), ['action' => 'view']);
		}
		else
		{
			$result = \lib\db\stores::access_store($shortname, \dash\user::id(), ['action' => 'view']);
		}

		if(!$result)
		{
			if($id)
			{
				$result = \lib\db\stores::get(['id' => $id, 'limit' => 1]);
			}
			elseif($shortname)
			{
				$result = \lib\db\stores::get(['shortname' => $shortname, 'limit' => 1]);
			}

			if($result)
			{
				if(\dash\permission::access('load:all:store', null, \dash\user::id()))
				{
					$result = $result;
				}
				else
				{
					\dash\temp::set('store_access_denied', true);
					\dash\temp::set('store_exist', true);
					$result = false;
				}
			}
		}

		if(!$result)
		{
			\dash\app::log('api:store:access:denide', \dash\user::id(), $log_meta);
			if($_options['debug'])
			{
				\dash\notif::error(T_("Can not access to load this store details"), 'store', 'permission');
			}
			return false;
		}

		if($_options['debug'])
		{
			// \dash\notif::title(T_("Operation complete"));
		}

		$result = self::ready($result);

		return $result;
	}
}
?>