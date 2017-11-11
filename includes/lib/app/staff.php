<?php
namespace lib\app;


/**
 * Class for staff.
 */
class staff extends \lib\app\user
{
	/**
	 * add new user and save the userstore record
	 *
	 * @param      <type>  $_args    The arguments
	 * @param      array   $_option  The option
	 */
	public static function add($_args, $_option = [])
	{
		$displayname = null;
		if(isset($_args['displayname']))
		{
			$displayname = $_args['displayname'];
		}
		else
		{
			if(isset($_args['firstname']))
			{
				$displayname = $_args['firstname'];
			}

			if(isset($_args['lastname']))
			{
				$displayname .= ' '. $_args['lastname'];
			}
		}

		$displayname = trim($displayname);

		unset($_args['type']);

		// save in contacts.store_id
		$_option['other_field']    = 'store_id';
		$_option['other_field_id'] = \lib\store::id();
		// add user
		$result = parent::add($_args, $_option);

		if(isset($result['user_id']))
		{
			$user_id = \lib\utility\shortURL::decode($result['user_id']);

			$insert_userstore =
			[
				'user_id'     => $user_id,
				'store_id'    => \lib\store::id(),
				'type'        => 'staff',
				'displayname' => $displayname,
			];

			$userstore_id = \lib\db\userstores::insert($insert_userstore);

			if(!$userstore_id)
			{
				\lib\app::log('cannot:add:user:to:userstore', \lib\user::id());
				\lib\debug::error(T_("Can not set the user in you store user list"));
				return false;
			}

			$result['userstore_id'] = \lib\utility\shortURL::encode($userstore_id);
		}
		return $result;
	}


	public static function list($_args = [])
	{
		$list = \lib\db\userstores::search(null, []);
		return $list;
	}


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
				\lib\app::log('api:staff:id:shortname:not:set', \lib\user::id(), $log_meta);
				debug::error(T_("Store id or shortname not set"), 'id', 'arguments');
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
			\lib\app::log('api:staff:access:denide', \lib\user::id(), $log_meta);
			if($_options['debug'])
			{
				debug::error(T_("Can not access to load this staff details"), 'staff', 'permission');
			}
			return false;
		}

		$get_contact_detail = \lib\db\contacts::get(['user_id' => $result['user_id'], 'store_id' => \lib\store::id()]);


		if(is_array($get_contact_detail))
		{
			$result = array_column($get_contact_detail, 'value', 'key');
		}
		else
		{
			$result = [];
		}


		return $result;
	}


	/**
	 * edit a staff
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function edit($_args, $_option = [])
	{
		\lib\app::variable($_args);

		$default_option =
		[
			'its_me' => false,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$its_me = false;
		if($_option['its_me'])
		{
			$its_me = true;
		}

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \lib\app::request(),
			]
		];

		// check args
		$args = $_args; //self::check($_option);

		if($args === false || !\lib\debug::$status)
		{
			return false;
		}


		if($its_me)
		{
			$userstore_id = null; // \lib\userstore::id();
		}
		else
		{
			$userstore_id = \lib\app::request('id');
			$userstore_id = \lib\utility\shortURL::decode($userstore_id);
		}

		if(!$userstore_id)
		{
			\lib\app::log('api:staff:edit:permission:denide', \lib\user::id(), $log_meta);
			debug::error(T_("Can not access to edit staff"), 'staff');
			return false;
		}

		$find_user_id = \lib\db\userstores::get(['id' => $userstore_id, 'store_id' => \lib\store::id(), 'limit' => 1]);
		if(!isset($find_user_id['user_id']))
		{
			\lib\app::log('api:staff:edit:userstores:not:found', \lib\user::id(), $log_meta);
			debug::error(T_("Can not access to edit staff"), 'staff');
			return false;
		}

		$_option['user_id']        = $find_user_id['user_id'];
		$_option['other_field']    = 'store_id';
		$_option['other_field_id'] = \lib\store::id();

		\lib\app\contact::merge($args, $_option);

		if(\lib\debug::$status)
		{
			\lib\debug::true(T_("Profile successfully updated"));
		}
	}
}
?>