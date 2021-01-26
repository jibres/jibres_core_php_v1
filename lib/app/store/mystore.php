<?php
namespace lib\app\store;


class mystore
{
	public static function list($_user_id = null)
	{
		if($_user_id)
		{
			$user_id = $_user_id;
		}
		else
		{
			$user_id = \dash\user::id();
		}

		if(!$user_id)
		{
			return false;
		}

		$store_user = \lib\db\store\store_user::get_my_store($user_id);

		$result             = [];
		$result['staff']    = [];
		$result['customer'] = [];
		$result['supplier'] = [];
		$result['owner']    = [];

		foreach ($store_user as $key => $value)
		{
			$value = \lib\app\store\ready::row($value);

			if(isset($value['owner']) && floatval(\dash\coding::decode($value['owner'])) === floatval($user_id))
			{
				$result['owner'][] = $value;
				continue;
			}

			if(isset($value['staff']) && $value['staff'] === 'yes')
			{
				$result['staff'][] = $value;
				continue;
			}

			if(isset($value['customer']) && $value['customer'] === 'yes')
			{
				$result['customer'][] = $value;
				continue;
			}

			if(isset($value['supplier']) && $value['supplier'] === 'yes')
			{
				$result['supplier'][] = $value;
				continue;
			}
		}



		return $result;
	}


	public static function get_count($_user_id = null)
	{
		if($_user_id)
		{
			$user_id = $_user_id;
		}
		else
		{
			$user_id = \dash\user::id();
		}

		if(!$user_id)
		{
			return false;
		}

		$store_user = \lib\db\store\store_user::get_my_store_count($user_id);

		return floatval($store_user);

	}

	public static function get_count_owner($_user_id = null)
	{
		if($_user_id)
		{
			$user_id = $_user_id;
		}
		else
		{
			$user_id = \dash\user::id();
		}

		if(!$user_id)
		{
			return false;
		}

		$store_user = \lib\db\store\store_user::get_my_store_count_owner($user_id);

		return floatval($store_user);

	}



}
?>