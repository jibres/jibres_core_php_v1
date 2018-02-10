<?php
namespace lib\app\thirdparty;


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
		$default_option =
		[
			'store_id' => null,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		\lib\app::variable($_args);

		if(!\lib\user::id())
		{
			\lib\debug::error(T_("user not found"), 'user');
			return false;
		}

		if(!\lib\store::id() && !$_option['store_id'])
		{
			\lib\debug::error(T_("store not found"), 'store');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\lib\debug::$status)
		{
			return false;
		}

		$return = [];

		if($_option['store_id'])
		{
			$args['store_id'] = $_option['store_id'];
		}
		else
		{
			$args['store_id'] = \lib\store::id();
		}

		if(!$args['status'])
		{
			$args['status']  = 'active';
		}

		if(isset($args['code']) && $args['code'])
		{

			$check_duplicate =
			[
				'code'  => $args['code'],
				'store_id' => \lib\store::id(),
				'limit'    => 1,
			];

			$check_duplicate = \lib\db\userstores::get($check_duplicate);

			if(isset($check_duplicate['id']))
			{
				\lib\debug::error(T_("Duplicate customer code in this store"), 'code');
				return false;
			}
		}

		$user_id = \lib\app\user::add($args, ['debug' => false, 'contact' => false]);

		if(!\lib\debug::$status || !isset($user_id['user_id']))
		{
			return false;
		}

		$user_id = \lib\utility\shortURL::decode($user_id['user_id']);

		$args['user_id'] = $user_id;

		$check_duplicate =
		[
			'user_id'  => $user_id,
			'store_id' => \lib\store::id(),
			'limit'    => 1,
		];

		$check_duplicate = \lib\db\userstores::get($check_duplicate);

		if(isset($check_duplicate['id']))
		{
			\lib\debug::error(T_("Duplicate user in this store"), 'duplicate');
			return false;
		}

		$userstore_id = \lib\db\userstores::insert($args);

		if(!$userstore_id)
		{
			\lib\app::log('api:thirdparty:no:way:to:insert:thirdparty', \lib\user::id(), \lib\app::log_meta());
			\lib\debug::error(T_("No way to insert :thirdparty"), 'db', 'system');
			return false;
		}

		$return['thirdparty_id'] = \lib\utility\shortURL::encode($userstore_id);

		if(\lib\debug::$status)
		{
			\lib\debug::true(T_("Thirdparty successfuly added"));
			\lib\app\store::user_count('thirdparty', true);
		}

		return $return;
	}
}
?>