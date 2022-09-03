<?php

namespace content_sudo\fix\user_store;

class controller
{

	public static function routing()
	{

		\dash\code::time_limit(0);

		$get_all_user_store = \dash\pdo::get("SELECT * FROM store_user WHERE 1 ");

		$result                           = [];
		$result['ok']                     = 0;
		$result['ok2']                     = 0;

		// in business user not found
		$result['a1']  = 0;
		$result['a1l'] = [];


		$result['a2']  = 0;
		$result['a2l'] = [];

		$result['a3']  = 0;
		$result['a3l'] = [];


		foreach ($get_all_user_store as $user_store)
		{
			$store =
				\dash\pdo::get(
					"SELECT * FROM store WHERE store.id = :id LIMIT 1",
					[':id' => a($user_store, 'store_id')],
					null,
					true,
					'master');

			\dash\engine\store::force_lock($store);

			$in_business_user_detail =
				\dash\pdo::get("SELECT * FROM users WHERE users.jibres_user_id = :jibres_user_id  LIMIT 1", [':jibres_user_id' => a($user_store, 'user_id')], null, true);

			$in_business_user_found = a($in_business_user_detail, 'id') ? true : false;
			$in_business_user_admin = a($in_business_user_detail, 'permission') ? true : false;
			$in_jibres_user_staff   = (a($user_store, 'staff') === 'yes') ? true : false;

			if(!$in_business_user_found)
			{
				$result['a1']++;
				$result['a1l'][] = [$user_store['id'], self::get_mobile($user_store)];
				continue;
			}

			if($in_business_user_admin && $in_jibres_user_staff)
			{
				$result['ok']++;
				continue;
			}

			if($in_business_user_admin && !$in_jibres_user_staff)
			{
				$result['a2']++;
				$result['a2l'][] = [$user_store['id'], self::get_mobile($user_store)];
				continue;
			}

			if(!$in_business_user_admin && $in_jibres_user_staff)
			{
				$result['a3']++;
				$result['a3l'][] = [$user_store['id'], self::get_mobile($user_store)];
				continue;
			}

			if(!$in_business_user_admin && !$in_jibres_user_staff)
			{
				$result['ok2']++;
				continue;
			}






			\dash\engine\store::unlock();
			\dash\pdo::close();
		}


		\dash\log::to_supervisor('user_store_result:' . json_encode($result));
		var_dump($result);
		exit;


	}


	private static function get_mobile($user_store)
	{
		return \dash\pdo::get("SELECT users.mobile FROM users WHERE users.id = :id LIMIT 1", [':id' => a($user_store, 'user_id')], 'mobile', true, 'master');

	}

}

?>