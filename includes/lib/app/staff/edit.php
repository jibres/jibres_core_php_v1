<?php
namespace lib\app\staff;


trait edit
{

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

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		// check args
		$args = self::check($_option);

		if($args === false || !\lib\debug::$status)
		{
			return false;
		}

		$userstore_id = \lib\app::request('id');
		$userstore_id = \lib\utility\shortURL::decode($userstore_id);
		if(!$userstore_id)
		{
			\lib\app::log('api:staff:edit:permission:denide:'. self::$type, \lib\user::id(), \lib\app::log_meta());
			\lib\debug::error(T_("Can not access to edit staff"), self::$type);
			return false;
		}

		$find_user_id = \lib\db\userstores::get(['id' => $userstore_id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(!isset($find_user_id['user_id']))
		{
			\lib\app::log('api:staff:edit:userstores:not:found:'. self::$type , \lib\user::id(), \lib\app::log_meta());
			\lib\debug::error(T_("Can not access to edit staff"), self::$type);
			return false;
		}

		if(\lib\app::request('mobile'))
		{
			$check_duplicate_mobile_in_store = \lib\db\userstores::is_duplicate_mobile(\lib\app::request('mobile'), self::$type, \lib\store::id());
			if(isset($check_duplicate_mobile_in_store['id']))
			{
				if(intval($check_duplicate_mobile_in_store['id']) === intval($userstore_id))
				{

				}
				else
				{
					\lib\app::log('app:staff:duplicate:user:in:store:'. self::$type , \lib\user::id());
					\lib\debug::error(T_("This user already exist in your staff list"), 'mobile');
					return false;
				}
			}
		}

		// to edit this user
		$_args['id'] = \lib\utility\shortURL::encode($find_user_id['user_id']);

		$_option['user_id']        = $find_user_id['user_id'];
		$_option['other_field']    = 'store_id';
		$_option['other_field_id'] = \lib\store::id();

		$result_edit = \lib\app\user::edit($_args, $_option);

		if(\lib\temp::get('app_user_id_changed'))
		{
			\lib\db\userstores::update(['user_id' => \lib\temp::get('app_new_user_id_changed')], $userstore_id);
		}

		\lib\db\userstores::update_cache($userstore_id);

		return $result_edit;

	}
}
?>