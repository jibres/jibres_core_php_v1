<?php
namespace content_c\store\add;


class view
{
	public static function config()
	{
		if(\dash\session::get('payment_request_start'))
		{
			\lib\app\store::after_pay();
			// \dash\notif::redirect(\dash\redirect::pwd());
			// \dash\code::end();
		}
		\dash\data::page_title(T_("Add New Store"));
		\dash\data::page_desc(T_("Add with simple detail and config more after adding new store."));
	}
}
?>
