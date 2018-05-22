<?php
namespace lib\app\store;


trait add
{

	/**
	 * add new store
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args = [])
	{
		\dash\app::variable($_args);

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
			\dash\app::log('api:store:user_id:notfound', \dash\user::id(), $log_meta);
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}
		// check store count
		$count_store = self::count_store_by_creator(\dash\user::id());

		if(\dash\url::isLocal())
		{
			// no check in local
		}
		else
		{
			if($count_store >= 1)
			{
				$user_budget = \dash\db\transactions::budget(\dash\user::id(), ['unit' => 'toman']);
				// if(is_array($user_budget))
				// {
				// 	$user_budget = array_sum($user_budget);
				// }
				$user_budget = floatval($user_budget);

				if($user_budget < 10000)
				{
					\dash\app::log('api:store:user_id:try:add:store2:budget:10000', \dash\user::id(), $log_meta);
					\dash\notif::error(T_("To register a second store, you need to have at least 10,000 toman in inventory on your account"));
					return false;
				}
			}

			if($count_store >= 3)
			{
				\dash\app::log('api:store:try:add:store3:and:>3', \dash\user::id(), $log_meta);
				\dash\notif::error(T_("You can not have more than three active stores. Contact support if needed"));
				return false;
			}
		}

		$return = [];

		\dash\temp::set('last_store_added', isset($args['slug'])? $args['slug'] : null);

		$args['creator'] = \dash\user::id();
		$args['status']  = 'enable';

		$store_id = \lib\db\stores::insert($args);

		if(!$store_id)
		{
			$args['slug'] = self::slug_fix($args);
			$store_id     = \lib\db\stores::insert($args);
		}

		if(!$store_id)
		{
			\dash\app::log('api:store:no:way:to:insert:store', \dash\user::id(), $log_meta);
			\dash\notif::error(T_("No way to insert store"), 'db', 'system');
			return false;
		}

		$insert_userstore =
		[
			'mobile'     => \dash\user::detail('mobile'),
			'firstname'  => \dash\user::detail('displayname') ?  \dash\user::detail('displayname') : T_("You"),
			'staff'      => 1,
			'gender'     => \dash\user::detail('gender'),
			'postion'    => T_('Admin'),
			'permission' => 'admin',
		];

		\lib\app\thirdparty::add($insert_userstore, ['debug' => false, 'store_id' => $store_id]);

		if(\dash\url::isLocal())
		{
			// in local mode not set the subdomain
		}
		else
		{
			\dash\utility\cloudflare::create_dns_record(['type' => 'CNAME', 'name' => $args['slug'], 'content' => 'jibres.com']);
		}

		$return['store_id'] = \dash\coding::encode($store_id);
		$return['slug']     = $args['slug'];

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Store successfuly added"));
		}

		return $return;
	}


	/**
	 * fix duplicate slug
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function slug_fix($_args)
	{
		if(!isset($_args['slug']))
		{
			$_args['slug'] = (string) \dash\user::id(). (string) rand(1000,5000);
		}

		$new_slug     = null;
		$similar_slug = \lib\db\stores::get_similar_slug($_args['slug']);
		$count        = count($similar_slug);
		$i            = 1;
		$new_slug     = (string) $_args['slug']. (string) ((int) $count +  (int) $i);
		while (in_array($new_slug, $similar_slug))
		{
			$i++;
			$new_slug = (string) $_args['slug']. (string) ((int) $count +  (int) $i);
		}

		\dash\temp::set('last_store_added', $new_slug);
		return $new_slug;
	}
}
?>