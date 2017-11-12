<?php
namespace lib\app;


/**
 * Class for staff.
 */
class staff extends \lib\app\user
{
	/**
	 * type of users
	 * staff
	 * costomer
	 * suplier
	 *
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
				\lib\app::log('app:staff:firstname:cannot:null'. self::$type , \lib\user::id());
				\lib\debug::error(T_("Firstname or Lastname of :staff can not be null", ['staff' => T_(self::$type)]), ['firstname', 'lastname']);
				return false;
			}
		}

		if(\lib\app::isset_request('birthday') && \lib\app::request('birthday'))
		{
			$birthday = \lib\utility\human::number(\lib\app::request('birthday'), 'en');
			if(strtotime($birthday) === false)
			{
				\lib\app::log('app:staff:invalid:birthday'. self::$type , \lib\user::id());
				\lib\debug::error(T_("birthday is incorrect"), 'birthday');
				return false;
			}
		}

		return parent::check(...func_get_args());
	}


	/**
	 * add new user and save the userstore record
	 *
	 * @param      <type>  $_args    The arguments
	 * @param      array   $_option  The option
	 */
	public static function add($_args, $_option = [])
	{
		\lib\app::variable($_args);

		if(isset($_args['mobile']))
		{
			$check_duplicate_mobile_in_store = \lib\db\userstores::is_duplicate_mobile($_args['mobile'], self::$type, \lib\store::id());
			if($check_duplicate_mobile_in_store)
			{
				\lib\app::log('app:staff:duplicate:user:in:store'. self::$type , \lib\user::id());
				\lib\debug::error(T_("This user already exist in your :staff list", ['staff' => T_(self::$type)]), 'mobile');
				return false;
			}
		}

		// check args
		$args = self::check($_option);

		if($args === false || !\lib\debug::$status)
		{
			return false;
		}

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
				'user_id'   => $user_id,
				'store_id'  => \lib\store::id(),
				'type'      => self::$type,
			];

			$userstore_id = \lib\db\userstores::insert($insert_userstore);

			if(!$userstore_id)
			{
				\lib\app::log('cannot:add:user:to:userstore'. self::$type , \lib\user::id());
				\lib\debug::error(T_("Can not set the user in you store user list"));
				return false;
			}

			\lib\db\userstores::update_cache($userstore_id);

			$result['userstore_id'] = \lib\utility\shortURL::encode($userstore_id);
		}
		return $result;
	}


	public static function list($_string = null, $_options = [])
	{
		$list = \lib\db\userstores::search($_string, $_options);
		$temp = [];
		if(is_array($list))
		{
			foreach ($list as $key => $value)
			{
				$a = parent::ready($value);
				if($a)
				{
					$temp[] = $a;
				}
			}
		}

		return $temp;
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
				\lib\app::log('api:staff:id:shortname:not:set'. self::$type , \lib\user::id(), $log_meta);
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
			\lib\app::log('api:staff:access:denide'. self::$type , \lib\user::id(), $log_meta);
			if($_options['debug'])
			{
				\lib\debug::error(T_("Can not access to load this :staff details", ['staff' => T_(self::$type)]), self::$type, 'permission');
			}
			return false;
		}

		$_options['other_field']    = 'store_id';
		$_options['other_field_id'] = \lib\store::id();
		$_options['user_id']        = $result['user_id'];
		$_args['id']                = \lib\utility\shortURL::encode($result['user_id']);

		return parent::get($_args, $_options);
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
		$args = self::check($_option);

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
			\lib\app::log('api:staff:edit:permission:denide'. self::$type, \lib\user::id(), $log_meta);
			\lib\debug::error(T_("Can not access to edit :staff", ['staff' => T_(self::$type)]), self::$type);
			return false;
		}

		$find_user_id = \lib\db\userstores::get(['id' => $userstore_id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(!isset($find_user_id['user_id']))
		{
			\lib\app::log('api:staff:edit:userstores:not:found'. self::$type , \lib\user::id(), $log_meta);
			\lib\debug::error(T_("Can not access to edit :staff", ['staff' => T_(self::$type)]), self::$type);
			return false;
		}

		if(isset($_args['mobile']))
		{
			$check_duplicate_mobile_in_store = \lib\db\userstores::is_duplicate_mobile($_args['mobile'], self::$type, \lib\store::id());
			if(isset($check_duplicate_mobile_in_store['id']))
			{
				if(intval($check_duplicate_mobile_in_store['id']) === intval($userstore_id))
				{

				}
				else
				{
					\lib\app::log('app:staff:duplicate:user:in:store'. self::$type , \lib\user::id());
					\lib\debug::error(T_("This user already exist in your :staff list", ['staff' => T_(self::$type)]), 'mobile');
					return false;
				}
			}
		}

		// to edit this user
		$_args['id'] = \lib\utility\shortURL::encode($find_user_id['user_id']);

		$_option['user_id']        = $find_user_id['user_id'];
		$_option['other_field']    = 'store_id';
		$_option['other_field_id'] = \lib\store::id();

		$result_edit = parent::edit($_args, $_option);

		if(\lib\temp::get('app_user_id_changed'))
		{
			\lib\db\userstores::update(['user_id' => \lib\temp::get('app_new_user_id_changed')], $userstore_id);
		}

		\lib\db\userstores::update_cache($userstore_id);

		return $result_edit;

	}
}
?>