<?php
namespace content_crm\ticket\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Show ticket"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/datalist');


		\dash\face::btnSetting(\dash\url::this(). '/setting?id='. \dash\request::get('id'));


		$ticket_id = \dash\data::dataRow_id();

		$conversation = \dash\app\ticket\get::conversation($ticket_id);

		\dash\data::conversation($conversation);

	}
}
?>
