<?php
namespace content_sudo\fix\user_store;

class controller
{

	public static function routing()
	{

		\dash\code::time_limit(0);

		$get_all_staff = \dash\pdo::get("SELECT * FROM store_user WHERE 1 ");

		$result                                           = [];
		$result['ok']                                     = 0;
		$result['in_store_admin_but_in_jibres_not_staff'] = 0;
		$result['in_store_customer_but_in_jibres_staff']  = 0;
		$result['ok2']                                    = 0;
		$result['user_not_found_in_store']                = 0;
		$result['list1']                                  = [];
		$result['list2']                                  = [];

		foreach ($get_all_staff as $key => $staff_detail)
		{
			$store = \dash\pdo::get("SELECT * FROM store WHERE store.id = :id LIMIT 1", [':id' => a($staff_detail, 'store_id')], null, true, 'master');

			\dash\engine\store::force_lock($store);

			$store_user_detail = \dash\pdo::get("SELECT * FROM users WHERE users.jibres_user_id = :jibres_user_id  LIMIT 1", [':jibres_user_id' => a($staff_detail, 'user_id')], null, true);

			if(isset($store_user_detail['permission']) && $store_user_detail['permission'])
			{
				if(isset($staff_detail['staff']) && $staff_detail['staff'] === 'yes')
				{
					$result['ok']++;
					// ok
				}
				else
				{
					$result['in_store_admin_but_in_jibres_not_staff']++;
					$result['list1'][] = $store_user_detail['mobile'];
				}
			}
			elseif(isset($store_user_detail['id']))
			{
				if(isset($staff_detail['staff']) && $staff_detail['staff'] === 'yes')
				{
					$result['in_store_customer_but_in_jibres_staff']++;
					$result['list2'][] = $store_user_detail['mobile'];
					// ok
				}
				else
				{
					$result['ok2']++;
				}
			}
			else
			{
				$result['user_not_found_in_store']++;
			}




			\dash\pdo::close();
		}


		\dash\log::to_supervisor('user_store_result:'. json_encode($result));
		var_dump($result);exit;



	}


	private static function get_mobile($staff_detail)
	{
		return \dash\pdo::get("SELECT users.mobile FROM users WHERE users.id = :id LIMIT 1", [':id' => a($staff_detail, 'user_id')], 'mobile', true, 'master');

	}
}
?>