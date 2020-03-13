<?php
namespace lib\app\sync;

/**
 * This class describes logo.
 */
class user
{
	/**
	 * Start sync logo from stores to jibres
	 */
	public static function jibres_user_id($_args)
	{
		if(!isset($_args['mobile']))
		{
			return null;
		}

		if(!\dash\engine\store::inStore() || !\lib\store::id())
		{
			return null;
		}

		$mobile = \dash\utility\filter::mobile($_args['mobile']);

		if(!$mobile)
		{
			return null;
		}

		$jibres_user_id = \dash\db\users\get::jibres_user_id($mobile);
		if(!$jibres_user_id)
		{
			$jibres_user_id = \dash\db\users\insert::jibres_signup($_args);
		}

		// can not signup in jibres
		if(!is_numeric($jibres_user_id))
		{
			$jibres_user_id = null;
		}

		$store_id = \lib\store::id();
		$creator  = \dash\user::jibres_user('id');

		if($jibres_user_id)
		{
			$check_store_user = \lib\db\store_user\get::jibres_check_store_user_record($store_id, $jibres_user_id);
			if(!isset($check_store_user['id']))
			{
				$store_user_record =
				[
					'store_id'    => $store_id,
					'user_id'     => $jibres_user_id,
					'creator'     => $creator,
					'staff'       => null,
					'customer'    => 'yes',
					'supplier'    => null,
					'datecreated' => date("Y-m-d H:i:s"),
				];

				\lib\db\store_user\insert::jibres_new_record($store_user_record);
			}
		}

		return $jibres_user_id;
	}
}
?>