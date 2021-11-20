<?php
namespace lib\app\instagram;

class remove
{

	public static function token()
	{

		\lib\db\setting\update::overwirte_cat_key(null, 'instagram', 'access_token');
		\lib\db\setting\update::overwirte_cat_key(null, 'instagram', 'user_id');

		\dash\notif::ok(T_("Connection removed"));
		return true;


	}
}
?>