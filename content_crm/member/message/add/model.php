<?php
namespace content_crm\member\message\add;


class model
{
	public static function post()
	{

		$text = \dash\validate::string_500(\dash\request::post('text'));
		if(!$text)
		{
			\dash\notif::error(T_("Please enter your message"), 'text');
			return false;
		}

		$log =
		[
			'from'        => \dash\user::id(),
			'to'          => \dash\coding::decode(\dash\request::get('id')),
			'notif_title' => T_("Administrator notification"),
			'notif_big'   => $text,

		];

		\dash\log::set('notif_text', $log);

		\dash\notif::ok(T_("Notification sended"));
		\dash\redirect::pwd();

	}
}
?>
