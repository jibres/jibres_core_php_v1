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
			\lib\app::log('api:store:user_id:notfound', null, $log_meta);
			\lib\notif::error(T_("User not found"), 'user');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\lib\engine\process::status())
		{
			return false;
		}
		// check store count
		$count_store = self::count_store_by_creator(\lib\user::id());

		if(\lib\url::isLocal())
		{
			// no check in local
		}
		else
		{
			if($count_store >= 1)
			{
				$user_budget = \lib\db\transactions::budget(\lib\user::id(), ['unit' => 'toman']);
				if(is_array($user_budget))
				{
					$user_budget = array_sum($user_budget);
				}
				$user_budget = floatval($user_budget);

				if($user_budget < 10000)
				{
					\lib\app::log('api:store:user_id:try:add:store2:budget:10000', null, $log_meta);
					\lib\notif::error(T_("To register a second store, you need to have at least 10,000 toman in inventory on your account"));
					return false;
				}
			}

			if($count_store >= 3)
			{
				\lib\app::log('api:store:try:add:store3:and:>3', null, $log_meta);
				\lib\notif::error(T_("You can not have more than three active stores. Contact support if needed"));
				return false;
			}
		}

		$return = [];

		\lib\temp::set('last_store_added', isset($args['slug'])? $args['slug'] : null);

		$args['creator'] = \lib\user::id();
		$args['status']  = 'enable';

		$store_id = \lib\db\stores::insert($args);

		if(!$store_id)
		{
			$args['slug'] = self::slug_fix($args);
			$store_id     = \lib\db\stores::insert($args);
		}

		if(!$store_id)
		{
			\lib\app::log('api:store:no:way:to:insert:store', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("No way to insert store"), 'db', 'system');
			return false;
		}

		$insert_userstore =
		[
			'mobile'    => \lib\user::detail('mobile'),
			'firstname' => \lib\user::detail('displayname') ?  \lib\user::detail('displayname') : T_("You"),
			'type'      => 'staff',
			'gender'    => \lib\user::detail('gender'),
			'postion'   => T_('Admin'),
		];

		\lib\app\thirdparty::add($insert_userstore, ['debug' => false, 'store_id' => $store_id]);

		if(\lib\url::isLocal())
		{
			// in local mode not set the subdomain
		}
		else
		{
			\lib\utility\cloudflare::create_dns_record(['type' => 'CNAME', 'name' => $args['slug'], 'content' => 'jibres.com']);
		}

		$return['store_id'] = \lib\coding::encode($store_id);
		$return['slug']     = $args['slug'];

		if(\lib\engine\process::status())
		{
			\lib\notif::ok(T_("Store successfuly added"));
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
			$_args['slug'] = (string) \lib\user::id(). (string) rand(1000,5000);
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

		\lib\temp::set('last_store_added', $new_slug);
		return $new_slug;
	}
}
?>