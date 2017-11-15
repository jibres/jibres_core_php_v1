<?php
namespace lib\app\supplier;


trait add
{

	/**
	 * add new user and save the userstore record
	 *
	 * @param      <type>  $_args    The arguments
	 * @param      array   $_option  The option
	 */
	public static function add($_args, $_option = [])
	{
		\lib\app::variable($_args);

		if(\lib\app::request('mobile'))
		{
			$check_duplicate_mobile_in_store = \lib\db\userstores::is_duplicate_mobile(\lib\app::request('mobile'), self::$type, \lib\store::id());
			if($check_duplicate_mobile_in_store)
			{
				\lib\app::log('app:supplier:duplicate:user:in:store:'. self::$type , \lib\user::id());
				\lib\debug::error(T_("This user already exist in your :supplier list", ['supplier' => T_(self::$type)]), 'mobile');
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
		$result = \lib\app\user::add($_args, $_option);

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
				\lib\app::log('cannot:add:user:to:userstore:'. self::$type , \lib\user::id());
				\lib\debug::error(T_("Can not set the user in you store"));
				return false;
			}

			\lib\db\userstores::update_cache($userstore_id);

			$result['userstore_id'] = \lib\utility\shortURL::encode($userstore_id);
		}
		return $result;
	}

}
?>