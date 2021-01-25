<?php
namespace content_business\ticket\view;

class view
{

	public static function config()
	{
		\dash\face::title(T_("View ticket No"));
		\dash\face::desc(T_("Check detail of your ticket."). ' '. T_("We try to answer to you as soon as posibble."));


		// btn
		\dash\data::back_text(T_('Tickets'));
		\dash\data::back_link(\dash\url::this());


		$ticket_id = \dash\data::dataRow_id();

		$conversation = \dash\app\ticket\get::conversation($ticket_id, true);

		\dash\data::conversation($conversation);

	}

}
?>