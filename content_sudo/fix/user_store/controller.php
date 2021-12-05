<?php
namespace content_sudo\fix\user_store;

class controller
{

	public static function routing()
	{

		\dash\code::time_limit(0);

		$get_all_staff = \dash\pdo::get("SELECT * FROM store_user WHERE store_user.staff != 'no' ");

		$result                              = [];
		$result['count_all_staff']           = count($get_all_staff);
		$result['count_have_permission']     = 0;
		$result['count_have_not_permission'] = 0;
		$result['count_not_exist']           = 0;

		foreach ($get_all_staff as $key => $staff_detail)
		{
			$store = \dash\pdo::get("SELECT * FROM store WHERE store.id = :id LIMIT 1", [':id' => a($staff_detail, 'store_id')], null, true, 'master');

			\dash\engine\store::force_lock($store);

			$have_permission = \dash\pdo::get("SELECT * FROM users WHERE users.jibres_user_id = :jibres_user_id AND users.permission IS NOT NULL LIMIT 1", [':jibres_user_id' => a($staff_detail, 'user_id')], null, true);

			if($have_permission)
			{
				$result['count_have_permission']++;
			}
			else
			{
				$have_not_permission = \dash\pdo::get("SELECT * FROM users WHERE users.jibres_user_id = :jibres_user_id  LIMIT 1", [':jibres_user_id' => a($staff_detail, 'user_id')], null, true);

				if($have_not_permission)
				{
					$result['count_have_not_permission']++;
				}
				else
				{
					$result['count_not_exist']++;
				}
			}


			\dash\db::close();
		}


		\dash\log::to_supervisor('user_store_result:'. json_encode($result));
		var_dump($result);exit;



	}
}
?>