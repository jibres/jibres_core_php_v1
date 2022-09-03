<?php
namespace content_love\business\userstore\change;


class model
{

	public static function post()
	{
		$update =
			[
				'staff'    => \dash\request::post('staff') ? 'yes' : 'no',
				'customer' => \dash\request::post('customer') ? 'yes' : 'no',
			];

		\lib\db\store_user\update::record($update, \dash\data::dataRow_id());

		\dash\notif::ok(T_("Update successfully"));

		\dash\redirect::pwd();


	}

}

?>
