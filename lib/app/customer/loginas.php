<?php
namespace lib\app\customer;


class loginas
{
	public static function user($_user_id, $_subdomain)
	{
		$load_store_detail = \lib\app\store\get::by_subdomain($_subdomain);

		if(isset($load_store_detail['id']) && isset($load_store_detail['fuel']))
		{

			$makeCustomer =
			[
				'jibres_user_id' => $_user_id,
				'firstname'      => \dash\user::jibres_user('firstname'),
				'lastname'       => \dash\user::jibres_user('lastname'),
				'gender'         => \dash\user::jibres_user('gender'),
				'mobile'         => \dash\user::jibres_user('mobile'),
				'avatar'         => \dash\user::jibres_user('avatar'),
			];

			$dbCustomerName = \dash\engine\store::make_database_name($load_store_detail['id']);

			$result = \lib\db\customer\insert::user($makeCustomer, $load_store_detail['fuel'], $dbCustomerName);

			return $result;

		}

		return false;

	}
}
?>